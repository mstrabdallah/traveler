<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $destinations = \App\Models\Destination::select('id', 'name', 'image')->get();
        return view('pages.contact', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Message::create($validated);

        return back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}
