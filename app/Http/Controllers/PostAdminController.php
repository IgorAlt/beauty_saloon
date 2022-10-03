<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostAdminController extends Controller
{
    /**
     * Отображает панель администрирования постов
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Posts::query()
            ->get()
            ->map(function ($post) {
                $post->image_path = Storage::url($post->images);

                return $post;
            });

        return view('posts_admin', ['posts' => $posts]);
    }

    /**
     * Показывает форму создания нового поста
     *
     * @return View
     */
    public function create(): View
    {
        return view('posts_form');
    }

    /**
     * Создаёт новый пост
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Posts::query()->create([
            'name_post' => $request->name_post,
            'post' => $request->post,
            'images' => $request->file('images')->store('uploads', 'public'),
        ]);

        return redirect()->route('posts_admin.index');
    }

    /**
     * Показывает форму для редактирования поста
     *
     * @param  Posts  $posts_admin
     * @return View
     */
    public function edit(Posts $posts_admin): View
    {
        return view('posts_form', ['posts_admin' => $posts_admin]);
    }

    /**
     * Редактирует пост
     *
     * @param  Request  $request
     * @param  Posts  $posts_admin
     * @return RedirectResponse
     */
    public function update(Request $request, Posts $posts_admin): RedirectResponse
    {
        $posts_admin->update([
            'name_post' => $request->name_post,
            'post' => $request->post,
            'images' => $request->file('images')->store('uploads', 'public')
        ]);

        return redirect()->route('posts_admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Posts  $posts_admin
     * @return RedirectResponse
     */
    public function destroy(Posts $posts_admin): RedirectResponse
    {
        $posts_admin->delete();

        return redirect()->route('posts_admin.index');
    }
}
