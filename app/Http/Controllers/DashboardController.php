<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubscriberDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'proposedArticles' => Article::where('user_id', auth()->id())
                                    ->where('status', 'proposed')
                                    ->latest()
                                    ->get(),
            'subscriptions' => [], // Add subscription model data here
            'history' => [], // Add browsing history model data here
            'conversations' => [], // Add conversations model data here
        ];

        return view('subscriber.dashboard', $data);
    }

    public function proposeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('article_images', 'public');

        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'image' => $imagePath,
            'user_id' => auth()->id(),
            'status' => 'proposed'
        ]);

        return redirect()->route('subscriber.dashboard')
            ->with('success', 'Article proposal submitted successfully!');
    }
}