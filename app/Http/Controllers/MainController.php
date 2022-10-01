<?php

namespace App\Http\Controllers;

use App\Models\Masters;
use App\Models\Media;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * comment
     *
     * @return View
     */
    public function index(): View
    {
        $masters = Masters::query()->get();
        $images = Media::query()->get();
        $posts = Posts::query()->limit(3)->get();

        return view('main', [
            'masters' => $masters,
            'images' => $images,
            'posts' => $posts,
        ]);
    }
}
