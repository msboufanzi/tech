<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'content' => 'required'
        ]);

        $article->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content']
        ]);

        return back();
    }
}