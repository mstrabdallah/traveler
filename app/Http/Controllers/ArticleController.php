<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::where('is_visible', true)
            ->whereDate('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('articles.index', compact('articles'));
    }

    public function show(\App\Models\Article $article)
    {
        abort_if(! $article->is_visible || $article->published_at->isFuture(), 404);
        
        return view('articles.show', compact('article'));
    }
}
