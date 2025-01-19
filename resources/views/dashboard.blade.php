@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subscriber Dashboard</h1>

    <nav>
        <ul>
            <li><a href="#subscriptions">My Subscriptions</a></li>
            <li><a href="#browsing-history">Browsing History</a></li>
            <li><a href="#propose-article">Propose an Article</a></li>
            <li><a href="#proposed-articles">Proposed Articles</a></li>
            <li><a href="#conversations">My Conversations</a></li>
        </ul>
    </nav>

    <section id="subscriptions">
        <h2>My Subscriptions</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Theme</th>
                    <th>Subscription Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add subscription data here -->
            </tbody>
        </table>
    </section>

    <section id="browsing-history">
        <h2>Browsing History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Article Title</th>
                    <th>Theme</th>
                    <th>Date Read</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add browsing history data here -->
            </tbody>
        </table>
    </section>

    <section id="propose-article">
        <h2>Propose an Article</h2>
        <form action="{{ route('subscriber.propose.article') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required class="form-control">
            </div>
            
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required class="form-control">
                    <option value="">Select a category</option>
                    <option value="Artificial Intelligence">Artificial Intelligence</option>
                    <option value="Cybersecurity">Cybersecurity</option>
                    <option value="Internet of Things">Internet of Things</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" required rows="10" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" required class="form-control-file">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit Proposal</button>
        </form>
    </section>

    <section id="proposed-articles">
        <h2>My Proposed Articles</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date Proposed</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposedArticles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category }}</td>
                    <td>{{ $article->created_at->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($article->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section id="conversations">
        <h2>My Conversations</h2>
        <div id="conversations-list">
            <!-- Add conversations data here -->
        </div>
    </section>
</div>
@endsection