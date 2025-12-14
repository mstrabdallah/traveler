<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('is_active', true)->get();
        return view('destinations.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        $destination->load('tours');
        return view('destinations.show', compact('destination'));
    }
}
