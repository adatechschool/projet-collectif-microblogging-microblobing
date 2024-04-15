<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class welcomeNotConnected extends Controller
{
    public function showPosts()
    {
        $posts = Post::all();
        return view('welcomeNotConnected', ['posts' => $posts]);
    }

    // public function update(Request $request, $id)
    // {
    //     $user = User::find($id);
    //     $user->update($request->all());
    //     return redirect()->route('user.show', $user->id);
    // }
}
