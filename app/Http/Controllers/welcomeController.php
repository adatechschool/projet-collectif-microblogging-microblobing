<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class welcomeController extends Controller
{
    public function showPosts()
    {
        $posts = Post::all();
    
        if(Auth::check()) {
            return view('welcome', ['posts' => $posts]);
        } else {
            return view('welcomeNotConnected', ['posts' => $posts]);
        }
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

    public function destroy(Post $post): RedirectResponse  {
        Gate::authorize('delete', $post);
        $post->delete();
        return redirect(route('posts.index'));
    }
}

   

