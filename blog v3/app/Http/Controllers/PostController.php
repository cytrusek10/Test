<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->paginate(6)->withQueryString();

        return view('posts.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('published', true)
            ->with('comments.user')
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }
}
