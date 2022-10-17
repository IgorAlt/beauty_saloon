<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    /**
     * Вывод формы регистрации
     *
     * @return void
     */
    public function test_register_form(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * Тест регистрации
     *
     * @return void
     */
    public function test_register_and_login(): void
    {
        $user = User::query()->create([
            'name' => uniqid(),
            'email' => uniqid() . '@mail.com',
            'password' => uniqid(),
        ]);

        $response = $this->post('/register', $user->toArray());

        $response->assertStatus(302);

        $userLogin = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $userLogin->assertStatus(302);

        $user->delete();
    }

    /**
     * Логаут
     *
     * @return void
     */
    public function test_logout(): void
    {
        $user = User::query()->create([
            'name' => uniqid(),
            'email' => uniqid() . '@mail.com',
            'password' => uniqid(),
        ]);

        $userLogin = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $userLogin->assertStatus(302);

        $userLogout = $this->post('/logout');

        $userLogout->assertStatus(302);

        $user->delete();
    }

    /**
     * Валидация регистрации
     *
     * @dataProvider invalidUsers
     */
    public function test_registration_validation($invalidData, $invalidFields)
    {
        $this->post(route('register'), $invalidData)->assertSessionHasErrors($invalidFields)
            ->assertStatus(302);

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * Проверка валидации регистрации
     *
     * @return array[]
     */
    public function invalidUsers(): array
    {
        return [
          [
              ['name' => 'User'],
              ['email', 'password'],
          ],
            [
                ['email' => 'email@email.com'],
                ['name', 'password'],
            ],
            [
                ['password' => 'password'],
                ['name', 'email'],
            ],
            [
                ['name' => 'User', 'email' => 'email@email.com'],
                ['password'],
            ],
            [
                ['name' => 'User', 'password' => 'password'],
                ['email'],
            ],
            [
                ['email' => 'email@email.com', 'password' => 'password'],
                ['name'],
            ],
            [
                ['name' => 'User', 'email' => 'a', 'password' => 'password'],
                ['email'],
            ],
            [
                ['name' => 'User', 'email' => '@', 'password' => 'password'],
                ['email'],
            ],
            [
                ['name' => 'User', 'email' => 'a@', 'password' => 'password'],
                ['email'],
            ],
            [
                ['name' => 'User', 'email' => 'a@', 'password' => '1234567'],
                ['email'],
            ],
        ];
    }
}
