@extends('layouts.app')

@section('title', 'Mój Randomowy Blog')

@push('styles')
<style>
    .hero {
        text-align: center;
        padding: 3rem 0 4rem;
        border-bottom: 1px solid var(--border);
        margin-bottom: 3rem;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: bold;
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .hero h1 em {
        color: var(--accent);
        font-style: normal;
    }

    .hero p {
        color: var(--muted);
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto;
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .post-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.5rem;
        text-decoration: none;
        color: var(--text);
        display: block;
        transition: border-color 0.2s, transform 0.2s;
    }

    .post-card:hover {
        border-color: var(--accent);
        transform: translateY(-3px);
    }

    .post-card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .post-card-date {
        color: var(--muted);
        font-size: 0.8rem;
        font-family: monospace;
    }

    .post-card h2 {
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .post-card p {
        color: var(--muted);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .post-card-footer {
        margin-top: 1.25rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
        font-size: 0.85rem;
        color: var(--accent);
        font-family: monospace;
    }

    .empty {
        text-align: center;
        padding: 4rem 0;
        color: var(--muted);
    }

    .empty h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 3rem;
    }

    .pagination a, .pagination span {
        display: inline-block;
        padding: 0.5rem 1rem;
        border: 1px solid var(--border);
        border-radius: 6px;
        color: var(--text);
        text-decoration: none;
        font-family: monospace;
        font-size: 0.85rem;
        transition: border-color 0.2s;
    }

    .pagination a:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    .pagination span.active {
        border-color: var(--accent);
        color: var(--accent);
    }
</style>
@endpush

@section('content')
    <div class="hero">
        <h1>Piszę o <em>losowych</em> rzeczach</h1>
        <p>Technologia, jedzenie, muzyka i wszystko pomiędzy. Bez sensu, za to z sercem.</p>
    </div>

    @if($posts->count() > 0)
        <div class="posts-grid">
            @foreach($posts as $post)
                <a href="{{ route('post.show', $post->slug) }}" class="post-card">
                    <div class="post-card-meta">
                        <span class="badge badge-{{ $post->category }}">{{ $post->category }}</span>
                        <span class="post-card-date">{{ $post->published_at->format('d.m.Y') }}</span>
                    </div>
                    <h2>{{ $post->title }}</h2>
                    @if($post->excerpt)
                        <p>{{ $post->excerpt }}</p>
                    @endif
                    <div class="post-card-footer">czytaj dalej →</div>
                </a>
            @endforeach
        </div>

        {{-- Paginacja --}}
        <div class="pagination">
            {{-- Poprzednia strona --}}
            @if($posts->onFirstPage())
                <span>← poprzednia</span>
            @else
                <a href="{{ $posts->previousPageUrl() }}">← poprzednia</a>
            @endif

            {{-- Numery stron --}}
            @foreach(range(1, $posts->lastPage()) as $page)
                @if($page == $posts->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $posts->url($page) }}">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Następna strona --}}
            @if($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}">następna →</a>
            @else
                <span>następna →</span>
            @endif
        </div>

    @else
        <div class="empty">
            <h2>Jeszcze nic tu nie ma 😅</h2>
            <p>Dodaj pierwszy post przez <a href="/admin" style="color: var(--accent)">panel admina</a></p>
        </div>
    @endif
@endsection
