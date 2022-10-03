<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\View\View;

class PostController extends Controller
{
    /**Показывает все посты
     * @return View
     */
    public function index(): View
    {
        $posts = Posts::all();
        return view('posts', ['posts' => $posts]);
    }

    /**Показывает конкретный пост
     * @param $request
     * @return View
     */
    public function post($request): View
    {
        $post = Posts::query()->where('id', $request)->first();
        return view('post', ['post' => $post]);
    }
}
