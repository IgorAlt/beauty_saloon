<?php

namespace App\Http\Controllers;

use App\Models\Masters;
use App\Models\Media;
use App\Models\Posts;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $masters = Masters::all();
        $images = Media::all();
        $posts = Posts::limit(3)->get();
        return view('main', compact('masters', 'images', 'posts'));
    }
}
