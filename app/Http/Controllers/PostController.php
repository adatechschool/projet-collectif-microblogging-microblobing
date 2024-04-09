<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class PostController extends Controller
{
    //
    public function show($id): View
    {
    $post = Post::findOrFail($id);
    return view('post', ['post' => $post]);
}
}
