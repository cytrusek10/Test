@extends('layouts.app')

@section('title', $post->title . ' – randomblog.pl')

@push('styles')
<style>
    .back-link {
        display: inline-block;
        color: var(--muted);
        text-decoration: none;
        font-family: monospace;
        font-size: 0.9rem;
        margin-bottom: 2.5rem;
        transition: color 0.2s;
    }

    .back-link:hover { color: var(--accent); }

    article {
        max-width: 680px;
        margin: 0 auto;
    }

    .post-header {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border);
    }

    .post-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .post-date {
        color: var(--muted);
        font-family: monospace;
        font-size: 0.85rem;
    }

    article h1 {
        font-size: 2.2rem;
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .post-excerpt {
        color: var(--muted);
        font-size: 1.1rem;
        line-height: 1.6;
        font-style: italic;
    }

    .post-content {
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .post-content p {
        margin-bottom: 1.5rem;
    }

    .post-content h2, .post-content h3 {
        margin: 2rem 0 1rem;
        color: var(--accent);
    }

    .post-content strong { color: var(--accent); }

    .post-content a {
        color: var(--accent2);
    }

    .post-content ul, .post-content ol {
        margin: 1rem 0 1.5rem 1.5rem;
    }

    .post-content li {
        margin-bottom: 0.5rem;
    }

    .post-content blockquote {
        border-left: 3px solid var(--accent);
        padding-left: 1.25rem;
        margin: 1.5rem 0;
        color: var(--muted);
        font-style: italic;
    }
</style>
@endpush

@section('content')
    @if(!$post->exists)
        <div style="background:#7f6a00;color:#fef08a;padding:0.75rem 1.25rem;border-radius:8px;margin-bottom:2rem;font-family:monospace;font-size:0.9rem;">
            ⚠️ To jest podgląd — post nie został jeszcze zapisany
        </div>
    @endif

    <a href="{{ route('home') }}" class="back-link">← wróć do listy</a>

    <article>
        <div class="post-header">
            <div class="post-meta">
                <span class="badge badge-{{ $post->category }}">{{ $post->category }}</span>
                <span class="post-date">{{ $post->published_at?->format('d.m.Y') ?? 'brak daty' }}</span>
            </div>
            <h1>{{ $post->title }}</h1>
            @if($post->excerpt)
                <p class="post-excerpt">{{ $post->excerpt }}</p>
            @endif
        </div>

        <div class="post-content">
            {!! $post->content !!}
        </div>
    </article>
@endsection
