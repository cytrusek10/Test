<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|max:255',
            'excerpt'      => 'nullable|max:500',
            'content'      => 'required',
            'category'     => 'required',
            'published'    => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug']         = Str::slug($validated['title']);
        $validated['published']    = $request->has('published');
        $validated['published_at'] = $validated['published_at'] ?? now();

        Post::create($validated);

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'        => 'required|max:255',
            'excerpt'      => 'nullable|max:500',
            'content'      => 'required',
            'category'     => 'required',
            'published'    => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug']         = Str::slug($validated['title']);
        $validated['published']    = $request->has('published');
        $validated['published_at'] = $validated['published_at'] ?? now();

        $post->update($validated);

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
