<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Posts::all();
        return view('posts', compact('posts'));
    }

    public function post()
    {
        $posts = Posts::all();
        return view('post', compact('posts'));
    }
}
