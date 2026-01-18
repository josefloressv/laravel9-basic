<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function blogIndex()
    {
        // $posts = Post::all();
        $posts = Post::latest()->paginate(10);
        // dd($posts); # Debug and Die
        // ddd($posts); # Debug, Dump and Die
        return view('blog.index', ['posts' => $posts]);
    }

    public function blogShow($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.show', ['post' => $post]);
    }
}
