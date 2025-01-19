@extends('layouts.app')

@section('content')
<div class="container">
    <main>
        @foreach($articles as $article)
        <article class="post">
            <h2>{{ $article->title }}</h2>
            <div class="meta">
                <span class="date">{{ $article->published_at->format('F d, Y') }}</span>
                <span class="author">by {{ $article->user->name }}</span>
            </div>
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="featured-image" />
            <p>
                {{ Str::limit($article->content, 200) }}
            </p>
            <br />
            <a href="{{ route('articles.show', $article) }}" class="read-more">Read More</a>
        </article>
        @endforeach
    </main>

    <aside>
        <section class="recent-articles">
            <h3>Recent Articles</h3>
            @foreach($recentArticles as $recentArticle)
            <article class="recent-post">
                <img src="{{ asset('storage/' . $recentArticle->image) }}" alt="{{ $recentArticle->title }}" class="recent-image" />
                <div class="recent-info">
                    <h4><a href="{{ route('articles.show', $recentArticle) }}">{{ $recentArticle->title }}</a></h4>
                    <p>
                        {{ Str::limit($recentArticle->content, 100) }}
                    </p>
                </div>
            </article>
            @endforeach
        </section>
    </aside>
</div>
@endsection