<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postIndex()
    {
        $posts = Post::all();
        return view('blog.index', ['posts' => $posts]);
    }

    public function postsShow($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.show', ['post' => $post]);
    }
}
