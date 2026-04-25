<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Post::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        $featuredPosts = Post::where('is_published', true)
            ->whereIn('slug', ['resilence', 'willpower', 'gratitude'])
            ->get();

        return view('blog', compact('posts', 'featuredPosts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $posts = Post::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        $featuredPosts = Post::where('is_published', true)
            ->whereIn('slug', ['resilence', 'willpower', 'gratitude'])
            ->get();
        
        return response()
            ->view('blog', compact('posts', 'post', 'featuredPosts'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
