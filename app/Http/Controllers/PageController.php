<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $posts = Post::latest('id')->get();
        return view('index', compact('posts'));
    }

    public function detail($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('post.detail', compact('post'));
    }
}
