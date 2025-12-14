<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TourController;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Article;

Route::get('/', function () {
    $featuredTours = Tour::where('is_active', true)->where('is_featured', true)->with('destination')->take(6)->get();
    $destinations = Destination::where('is_active', true)->take(5)->get();
    $latestArticles = Article::where('is_visible', true)->latest()->take(3)->get();
    return view('welcome', compact('featuredTours', 'destinations', 'latestArticles'));
});

Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination:slug}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/{tour:slug}', [TourController::class, 'show'])->name('tours.show');
Route::post('/tours/{tour:slug}/book', [\App\Http\Controllers\BookingController::class, 'store'])->name('tours.book');

Route::get('/blog', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/blog/{article:slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

use App\Http\Controllers\CustomTourRequestController;
Route::get('/tailor-made', [CustomTourRequestController::class, 'create'])->name('custom-tour.create');
Route::post('/tailor-made', [CustomTourRequestController::class, 'store'])->name('custom-tour.store');
