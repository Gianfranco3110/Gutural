<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::latest('published_at')->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create', ['post' => null]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'subtitle'     => ['nullable', 'string', 'max:255'],
            'excerpt'      => ['nullable', 'string'],
            'content'      => ['nullable', 'string'],
            'collection'   => ['required', 'in:resilencia,willpower,gratitude,general'],
            'is_published' => ['boolean'],
            'image'        => ['nullable', 'image', 'max:5120'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'title'        => $validated['title'],
            'slug'         => Str::slug($validated['title']),
            'subtitle'     => $validated['subtitle'] ?? null,
            'excerpt'      => $validated['excerpt'] ?? null,
            'content'      => $validated['content'] ?? null,
            'collection'   => $validated['collection'],
            'is_published' => $request->boolean('is_published', true),
            'image'        => $imagePath,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', "Post \"{$post->title}\" creado exitosamente.");
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'subtitle'     => ['nullable', 'string', 'max:255'],
            'excerpt'      => ['nullable', 'string'],
            'content'      => ['nullable', 'string'],
            'collection'   => ['required', 'in:resilencia,willpower,gratitude,general'],
            'is_published' => ['boolean'],
            'image'        => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title'        => $validated['title'],
            'slug'         => Str::slug($validated['title']),
            'subtitle'     => $validated['subtitle'] ?? null,
            'excerpt'      => $validated['excerpt'] ?? null,
            'content'      => $validated['content'] ?? null,
            'collection'   => $validated['collection'],
            'is_published' => $request->boolean('is_published', true),
            'image'        => $validated['image'] ?? $post->image,
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', "Post \"{$post->title}\" actualizado exitosamente.");
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post eliminado exitosamente.');
    }

    public function togglePublished(Post $post): RedirectResponse
    {
        $post->update(['is_published' => ! $post->is_published]);

        return back()->with('success', "Post \"" . $post->title . "\" " . ($post->is_published ? 'publicado' : 'despublicado') . ".");
    }
}
