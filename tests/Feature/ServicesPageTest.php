<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServicesPageTest extends TestCase
{
    /**
     * Вывод всех услуг
     *
     * @return void
     */
    public function test_services(): void
    {
        $response = $this->get('/services');

        $response->assertStatus(200);
    }
}
