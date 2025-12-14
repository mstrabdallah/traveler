<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $destinations = \App\Models\Destination::select('id', 'name', 'image')->get();
        $toursCount = \App\Models\Tour::where('is_active', true)->count();
        $destinationsCount = \App\Models\Destination::where('is_active', true)->count();
        
        return view('pages.about', compact('destinations', 'toursCount', 'destinationsCount'));
    }
}
