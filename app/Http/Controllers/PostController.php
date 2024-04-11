<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    //
    public function show($id): View
    {
    $post = Post::findOrFail($id);
    return view('post', ['displayPost' => $post]);
}

public function index(): View
{
return view('index', [
    'posts' => Post::with('user')->latest()->get(),
]);
}

public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'=> 'required|string|max:50',
            'picture' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'tag' => 'required|string|max:20',
        ]);
        $request->user()->posts()->create($validated);
        return redirect(route('posts.index'));

    }
    public function edit(Post $post): View
    {


        Gate::authorize('update', $post);

        return view('editPost', [

            'post' => $post,

        ]);

    }
    public function update(Request $request, Post $post): RedirectResponse
    {


        Gate::authorize('update', $post);

        $validated = $request->validate([
             'title'=> 'required|string|max:50',
             'picture' => 'required|string|max:255',
            'content' => 'required|string|max:255',
             'tag' => 'required|string|max:20'
        ]);

        $post->update($validated);
        return redirect(route('posts.index'));

    }
}
