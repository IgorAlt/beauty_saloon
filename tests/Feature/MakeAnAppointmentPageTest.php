<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class MakeAnAppointmentPageTest extends TestCase
{
    private User $user;

    /**
     * Вывод формы для записи на приём
     *
     * @return void
     */
    public function test_an_appointment_form(): void
    {
        $response = $this->get('/appointment');

        $response->assertOk();
    }
}
