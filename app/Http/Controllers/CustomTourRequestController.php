<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CustomTourRequest;

class CustomTourRequestController extends Controller
{
    public function create()
    {
        return view('custom-tour-request.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'request_title' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'arrival_date' => 'nullable|date',
            'departure_date' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'country_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
            'adults' => 'integer|min:1',
            'children' => 'integer|min:0',
            'ages_range' => 'nullable|string|max:255',
            'destinations' => 'nullable|array',
            'accommodation' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'referral_source' => 'nullable|string|max:255',
        ]);

        CustomTourRequest::create($validated);

        return redirect()->route('custom-tour.create')->with('success', 'Your inquiry has been sent successfully! We will contact you soon.');
    }
}
