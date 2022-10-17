<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /**
     * Вывод формы логина
     *
     * @return void
     */
    public function test_login_form(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Тест логина
     *
     * @return void
     */
    public function test_login(): void
    {
        $this->post('/login', [
            'email' => 'albert.kuminov@mail.ru',
            'password' => '12345678',
        ])->assertStatus(302);
    }
}
