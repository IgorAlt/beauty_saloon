<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use App\Http\Resources\PostResource;
use App\Models\Posts;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{
    /**Страница со всеми постами
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $posts = Posts::all();
        return PostResource::collection($posts);
    }

    /**Показывает конкретного мастера
     * @param Posts $post
     * @return JsonResource
     */
    public function show(Posts $post): JsonResource
    {
        return PostResource::make($post);
    }
}
