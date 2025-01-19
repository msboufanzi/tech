<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(5);

        $recentArticles = Article::where('status', 'published')
            ->latest('published_at')
            ->take(10)
            ->get();
            
        return view('articles', compact('articles', 'recentArticles'));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        $article->load(['user', 'comments.user', 'ratings']);
        $recentArticles = Article::where('status', 'published')
            ->latest('published_at')
            ->where('id', '!=', $article->id)
            ->take(10)
            ->get();
            
        return view('article_details', compact('article', 'recentArticles'));
    }
}