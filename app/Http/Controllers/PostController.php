<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;


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
return view('index');
}
}
