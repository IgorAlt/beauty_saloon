<?php

namespace Tests\Feature;

use App\Models\Masters;
use App\Models\Media;
use App\Models\Posts;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MainPageTest extends TestCase
{
    /**
     * Тест главной страницы
     *
     * @return void
     */
    public function test_the_main_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }

    /**
     * Тест вывода постов на главной странице
     *
     * @return void
     */
    public function test_the_posts_at_the_main_page(): void
    {
        $posts = Posts::query()->limit(3)->get()
            ->map(function ($post) {
                $post->image_path = Storage::url($post->images);
                return $post;
            });

        $response = $this->get('/', $posts->toArray());

        $response->assertOk();
    }

    /**
     * Тест вывода мастеров на главной странице
     *
     * @return void
     */
    public function test_masters_at_the_main_page(): void
    {
        $masters = Masters::query()->get()
            ->map(function ($master) {
                $master->image_path = Storage::url($master->images);
                return $master;
            });

        $response = $this->get('/', $masters->toArray());

        $response->assertOk();
    }

    /**
     * Тест вывода картинок в слайдере на главной странице
     *
     * @return void
     */
    public function test_media_at_the_main_page(): void
    {
        $images = Media::query()->get();

        $response = $this->get('/', $images->toArray());

        $response->assertOk();
    }
}
