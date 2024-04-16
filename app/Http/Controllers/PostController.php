<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


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

public function store(Request $request)
{

    
    $this->validate($request, [
            'title'=> 'required|string|max:50',
            'picture' => 'required|image|max:1024',
            'content' => 'required|string|max:255',
            'tag' => 'required|string|max:20',
        ]);

        $chemin_image = $request->picture->store("public/posts");
        $chemin_image = str_replace("public/", "", $chemin_image);
       

        Post::create([
            "title" => $request->title,
            "picture" => $chemin_image,
            "content" => $request->content,
            "tag" => $request->tag,
            "updated_at"=> $request->updated_at,
            "created_at"=> $request->created_at,
            "user_id" => auth()->user()->id,
        ]);
        

        return redirect(route("posts.index"));

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
             'picture' => 'required|image|max:1024',
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
