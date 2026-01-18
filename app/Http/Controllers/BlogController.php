<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function blogIndex()
    {
        $posts = [
            ['slug' => "first-post", 'title' => 'First Post A', 'summary' => 'This is the first post.'],
            ['slug' => "second-post", 'title' => 'Second Post B', 'summary' => 'This is the second post.'],
            ['slug' => "third-post", 'title' => 'Third Post C', 'summary' => 'This is the third post.'],
        ];
        return view('blog.index', ['posts' => $posts]);
    }

    public function blogShow($slug)
    {
        $post = [
            'title' => "Post details",
            'summary' => "This is the post detail for $slug.",
            'slug' => $slug,
        ];
        return view('blog.show', ['post' => $post]);
    }
}