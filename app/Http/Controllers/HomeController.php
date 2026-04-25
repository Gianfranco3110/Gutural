<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(): View
    {
        $posts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('posts'));
    }
}
