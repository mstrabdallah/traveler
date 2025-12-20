<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::where('is_active', true)->with('destination');

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        } elseif ($request->has('type') && $request->type) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->type . '%');
            });
        }

        // Note: 'date_from' and 'guests' are captured for UI pre-filling but 
        // strictly don't filter the tour list without specific availability models.

        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
             case 'duration_asc':
                $query->orderBy('duration_days', 'asc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default: // featured
                $query->orderBy('is_featured', 'desc')->orderBy('name', 'asc');
                break;
        }

        $tours = $query->paginate(12);

        return view('tours.index', compact('tours'));
    }

    public function show(Tour $tour)
    {
        return view('tours.show', compact('tour'));
    }
}
