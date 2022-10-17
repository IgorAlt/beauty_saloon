<?php

namespace App\Http\Controllers;

use App\Models\Masters;
use App\Models\Media;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Главная страница
     *
     * @return View
     */
    public function index(): View
    {
        $masters = Masters::query()->get()
            ->map(function ($master) {
                $master->image_path = Storage::url($master->images);
                return $master;
            });
        $images = Media::query()->get();
        $posts = Posts::query()->limit(3)->get()
            ->map(function ($post) {
                $post->image_path = Storage::url($post->images);
                return $post;
            });

        return view('main', [
            'masters' => $masters,
            'images' => $images,
            'posts' => $posts,
        ]);
    }
}
