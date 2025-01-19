<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5'
        ]);

        $article->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['rating' => $validated['rating']]
        );

        return back();
    }
}