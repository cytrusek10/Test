@extends('layouts.app')

@section('title', 'Edytuj post')

@push('styles')
<style>
    .form-group { margin-bottom: 1.25rem; }
    label { display: block; margin-bottom: 0.4rem; color: var(--muted); font-family: monospace; font-size: 0.85rem; }
    input[type="text"], input[type="datetime-local"], select, textarea {
        width: 100%;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 0.6rem 0.85rem;
        color: var(--text);
        font-size: 0.95rem;
        font-family: inherit;
    }
    textarea { min-height: 300px; resize: vertical; }
    input[type="checkbox"] { margin-right: 0.5rem; }
    .btn { display: inline-block; padding: 0.6rem 1.5rem; border-radius: 6px; font-family: monospace; font-size: 0.9rem; text-decoration: none; cursor: pointer; border: none; }
    .btn-primary { background: var(--accent); color: #000; }
    .back-link { display: inline-block; color: var(--muted); text-decoration: none; font-family: monospace; font-size: 0.9rem; margin-bottom: 2rem; }
</style>
@endpush

@section('content')
    <a href="{{ route('admin.posts.index') }}" class="back-link">← wróć do listy</a>
    <h1 style="margin-bottom:2rem">Edytuj post</h1>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Tytuł</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="form-group">
            <label>Kategoria</label>
            <select name="category" required>
                @foreach(['technologia' => '💻 Technologia', 'zycie' => '🌿 Życie', 'jedzenie' => '🍕 Jedzenie', 'muzyka' => '🎵 Muzyka', 'sport' => '⚽ Sport', 'inne' => '🎲 Inne'] as $value => $label)
                    <option value="{{ $value }}" {{ old('category', $post->category) === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Krótki opis (zajawka)</label>
            <textarea name="excerpt" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label>Treść</label>
            <textarea name="content" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="form-group">
            <label>Data publikacji</label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="published" value="1" {{ old('published', $post->published) ? 'checked' : '' }}>
                Opublikowany
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
@endsection
