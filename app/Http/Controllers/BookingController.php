<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, \App\Models\Tour $tour)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required|string',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'service_booking' => 'nullable|boolean',
            'service_person' => 'nullable|boolean',
        ]);

        // Calculate Price Logic
        $basePrice = $tour->price;
        $childPrice = $tour->price * 0.5;
        $serviceBookingPrice = 30; // Fixed extra
        $servicePersonPrice = 15; // Fixed extra per person

        $total = ($validated['adults'] * $basePrice) + 
                 (($validated['children'] ?? 0) * $childPrice);

        if ($request->boolean('service_booking')) {
            $total += $serviceBookingPrice;
        }

        if ($request->boolean('service_person')) {
            $total += $servicePersonPrice * ($validated['adults'] + ($validated['children'] ?? 0));
        }

        $booking = \App\Models\Booking::create([
            'tour_id' => $tour->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'date' => $validated['date'],
            'adults' => $validated['adults'],
            'children' => $validated['children'] ?? 0,
            'total_price' => $total,
            'status' => 'pending',
            'meta' => [
                'time' => $validated['time'],
                'service_booking' => $request->has('service_booking'),
                'service_person' => $request->has('service_person'),
            ]
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your booking request has been received! referencing #' . $booking->id,
            ]);
        }

        return back()->with('success', 'Your booking request has been received! referencing #' . $booking->id);
    }
}
