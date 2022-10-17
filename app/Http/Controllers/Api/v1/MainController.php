<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use App\Http\Resources\MediaResource;
use App\Http\Resources\PostResource;
use App\Models\Masters;
use App\Models\Media;
use App\Models\Posts;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    /**
     * Главная страница
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
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

        return response()->json([
            'data' => [
                'masters' => MasterResource::collection($masters),
                'images' => MediaResource::collection($images),
                'posts' => PostResource::collection($posts),
            ],
        ]);
    }
}
