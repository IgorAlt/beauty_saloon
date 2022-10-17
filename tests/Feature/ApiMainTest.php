<?php

namespace Tests\Feature;

use App\Models\Posts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiMainTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест Данных главной страницы
     *
     * @return void
     */
    public function test_data(): void
    {
        $response = $this->json('GET', route('api-main'));

        $response->assertJson(fn(AssertableJson $json) => $json->has('data'));
    }

    /**
     * Тест Данных главной страницы
     *
     * @return void
     */
    public function test_data_posts(): void
    {
        $post = Posts::query()->create([
           'name_post' => 'post',
           'post' => 'post',
           'images' => 'image.jpg',
        ])->first();
        $response = $this->json('GET', route('api-main'));

        $response->assertJsonPath('data.posts.0', [
                    'id' => $post->id,
                    'name_post' => $post->name_post,
                    'post' => $post->post,
                    'images' => $post->images,
        ]);
    }
}
