<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $destinations = \App\Models\Destination::select('id', 'name', 'image')->get();
        return view('pages.about', compact('destinations'));
    }
}
