<?php

namespace Tests\Feature;

use App\Models\Masters;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MastersPageTest extends TestCase
{
    /**
     * Страница со всеми мастерами
     *
     * @return void
     */
    public function test_masters(): void
    {
        $response = $this->get('/masters');

        $response->assertStatus(200);
    }

    /**
     * Вывод конкретного мастера
     *
     * @return void
     */
    public function test_master(): void
    {
        Masters::query()->create([
            'name' => 'Pussy',
            'surname' => 'Pussievich',
            'phone_number' => '89188828963',
            'social_media' => 'hui_tam',
            'images' => 'hui_zdes',
            'information' => 'hui_gde_to',
        ]);
        $masters = Masters::query()->get();

        foreach ($masters as $master) {
            $response = $this->get("/masters/$master->id");

            $response->assertOk();
        }
    }
}
