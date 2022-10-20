<?php

namespace Tests\Feature;

use App\Models\Masters;
use App\Models\Media;
use App\Models\Posts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiMainTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест данных главной страницы
     *
     * @return void
     */
    public function test_data(): void
    {
        $response = $this->json('GET', route('api-masters'));

        $response->assertJson(fn(AssertableJson $json) => $json->has('data'));
    }

    /**
     * Тест данных постов
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

    /**
     * Тест данных мастеров
     *
     * @return void
     */
    public function test_data_masters(): void
    {
        $master = Masters::query()->create([
            'name' => 'master',
            'surname' => 'surname',
            'phone_number' => '89188828961',
            'social_media' => 'social_media',
            'images' => 'image',
            'information' => 'information',
        ])->first();
        $response = $this->json('GET', route('api-main'));

        $response->assertJsonPath('data.masters.0', [
            'id' => $master->id,
            'name' => $master->name,
            'surname' => $master->surname,
            'phone_number' => $master->phone_number,
            'social_media' => $master->social_media,
            'images' => $master->images,
            'information' => $master->information,
        ]);
    }

    /**
     * Тест данных картинок
     *
     * @return void
     */
    public function test_data_images(): void
    {
        $image = Media::query()->create([
            'image' => 'image',
            'description' => 'description',
        ])->first();
        $response = $this->json('GET', route('api-main'));

        $response->assertJsonPath('data.images.0', [
            'id' => $image->id,
            'image' => $image->image,
            'description' => $image->description,
        ]);
    }
}
