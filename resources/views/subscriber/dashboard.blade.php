@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <nav class="dashboard-nav">
        <div class="logo">Tech Horizon</div>
        <ul>
            <li><a href="#subscriptions">My Subscriptions</a></li>
            <li><a href="#browsing-history">Browsing History</a></li>
            <li><a href="#propose-article">Propose an Article</a></li>
            <li><a href="#proposed-articles">Proposed Articles</a></li>
            <li><a href="#conversations">My Conversations</a></li>
        </ul>
    </nav>

    <main class="dashboard-main">
        <h1>Subscriber Dashboard</h1>

        <section id="subscriptions">
            <h2>My Subscriptions</h2>
            <table id="subscriptions-table">
                <thead>
                    <tr>
                        <th>Theme</th>
                        <th>Subscription Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions ?? [] as $subscription)
                    <tr>
                        <td>{{ $subscription->theme }}</td>
                        <td>{{ $subscription->created_at->format('M d, Y') }}</td>
                        <td>
                            <button class="btn-action">Unsubscribe</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="browsing-history">
            <h2>Browsing History</h2>
            <table id="history-table">
                <thead>
                    <tr>
                        <th>Article Title</th>
                        <th>Theme</th>
                        <th>Date Read</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history ?? [] as $item)
                    <tr>
                        <td>{{ $item->article_title }}</td>
                        <td>{{ $item->theme }}</td>
                        <td>{{ $item->read_at->format('M d, Y') }}</td>
                        <td>
                            <button class="btn-action">View</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="propose-article">
            <h2>Propose an Article</h2>
            <form action="{{ route('subscriber.propose.article') }}" method="POST" enctype="multipart/form-data" id="article-proposal-form">
                @csrf
                <div class="form-group">
                    <label for="article-title">Title:</label>
                    <input type="text" id="article-title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="article-theme">Theme:</label>
                    <select id="article-theme" name="category" required>
                        <option value="">Select a theme</option>
                        <option value="Artificial Intelligence">Artificial Intelligence</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                        <option value="Internet of Things">Internet of Things</option>
                        <option value="Cloud Computing">Cloud Computing</option>
                        <option value="Game Development">Game Development</option>
                        <option value="Data Science">Data Science</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="article-content">Content:</label>
                    <textarea id="article-content" name="content" required rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="article-image">Featured Image:</label>
                    <input type="file" id="article-image" name="image" accept="image/*" required>
                </div>
                
                <button type="submit" class="btn-primary">Submit Proposal</button>
            </form>
        </section>

        <section id="proposed-articles">
            <h2>My Proposed Articles</h2>
            <table id="proposed-articles-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Theme</th>
                        <th>Date Proposed</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposedArticles ?? [] as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->category }}</td>
                        <td>{{ $article->created_at->format('M d, Y') }}</td>
                        <td>{{ ucfirst($article->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="conversations">
            <h2>My Conversations</h2>
            <div id="conversations-list">
                @foreach($conversations ?? [] as $conversation)
                <div class="conversation-item">
                    <h3>{{ $conversation->title }}</h3>
                    <p>{{ $conversation->last_message }}</p>
                    <span class="date">{{ $conversation->updated_at->format('M d, Y') }}</span>
                </div>
                @endforeach
            </div>
        </section>
    </main>
</div>

<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.dashboard-nav {
    background: #f5f5f5;
    padding: 20px;
    margin-bottom: 30px;
}

.dashboard-nav ul {
    list-style: none;
    padding: 0;
    margin: 20px 0 0;
}

.dashboard-nav li {
    margin-bottom: 10px;
}

.dashboard-nav a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
}

.dashboard-main section {
    margin-bottom: 40px;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
}

input[type="text"],
select,
textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.btn-primary {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background: #0056b3;
}

.btn-action {
    background: #6c757d;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.conversation-item {
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

.conversation-item:last-child {
    border-bottom: none;
}

.conversation-item h3 {
    margin: 0 0 10px;
}

.conversation-item .date {
    color: #6c757d;
    font-size: 0.9em;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 10px;
    }
    
    table {
        display: block;
        overflow-x: auto;
    }
}
</style>
@endsection