<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => 0,
            'phone' => '89997776655',
            'loyalty_level' => 0,
            'full_sum' => 100,
        ]);
    }

    /**
     * Тест личной страницы пользователя
     *
     * @return void
     */
    public function test_home_page(): void
    {
        $this->loginUser($this->user);
        $this->get(route('home'))
            ->assertOk();
    }

    /**
     * Тест изменения данных пользователя
     *
     * @return void
     */
    public function test_user_change_information(): void
    {
        $this->loginUser($this->user);

        $this->get(route('change-user-information', $this->user->id))
            ->assertOk();

        $this->put(route('update-user-information', $this->user->id), [
            'name' => 'Hui',
            'email' => 'albert.kuminov@mail.ru',
            'phone' => '89188828960',
        ])->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Hui',
            'email' => 'albert.kuminov@mail.ru',
            'phone' => '89188828960',
        ]);
    }

    public function test_unauthorized_user_has_not_access()
    {
        $this->get(route('home'))
            ->assertRedirect(route('login'));
    }

    public function test_user_can_not_change_another_info()
    {
        /** @var User $userOurEnemy */
        $userOurEnemy = User::query()->create([
            'name' => 'enemy',
            'email' => 'enemy@enemy.enemy',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_admin' => 0,
            'phone' => '89997776655',
            'loyalty_level' => 0,
            'full_sum' => 100,
        ]);
        $this->loginUser($userOurEnemy);

        $this->put(route('update-user-information', $this->user->id), [
            'name' => 'Pussy',
            'email' => 'albert.kuminov@mail.ru',
            'phone' => '89188828960',
        ])->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', [
            'name' =>  $this->user->name,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
        ]);
    }

    /**
     * Тест того, что в шаблоне отображается данные пользователя
     *
     * @return void
     */
    public function test_user_data_exist(): void
    {
        $this->loginUser($this->user);

        $user = $this->user;
        $userAppointmentsPast = Appointment::query()->where('email', $user->email)
            ->where('appointment_time', '<', Carbon::today()->toDateTimeString())->get();
        $userAppointmentsFuture = Appointment::query()->where('email', $user->email)
            ->where('appointment_time', '>=', Carbon::today()->toDateTimeString())->get();

        $this->view('home', [
            'user' => $user,
            'userAppointmentsPast' => $userAppointmentsPast,
            'userAppointmentsFuture' => $userAppointmentsFuture,
        ])->assertViewHas('user', function (User $user) {
            return $user->name === 'test';
        })->assertViewHas('user', function (User $user) {
            return $user->phone === '89997776655';
        })->assertViewHas('user', function (User $user) {
            return $user->email === 'test@test.test';
        })->assertViewHas('user', function (User $user) {
            return $user->loyalty_level === 0;
        })->assertViewHas('userAppointmentsPast', $userAppointmentsPast)
            ->assertViewHas('userAppointmentsFuture', $userAppointmentsFuture);
    }

    public function test_appointment()
    {
        $this->loginUser($this->user);

        $this->post(route('create-appointment'))->assertStatus(302);

        $this->post(route('create-appointment'), [
            'name' => 'testName',
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'surname' => 'testSurname',
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'phone_number' => 'testPhone',
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'price' => 'testPrice',
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'appointment_time' => Carbon::tomorrow()->toDateTimeString(),
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'name' => 'testName',
            'surname' => 'testSurname',
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'name' => 'testName',
            'phone_number' => 'testPhone',
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'name' => 'testName',
            'price' => 'testPrice',
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'name' => 'testName',
            'appointment_time' => Carbon::tomorrow()->toDateTimeString(),
        ])->assertStatus(302);

        $this->post(route('create-appointment'), [
            'name' => $this->user->name,
            'surname' => 'testSurname',
            'phone_number' => $this->user->phone,
            'email' => $this->user->email,
            'appointment_time' => Carbon::tomorrow()->toDateTimeString(),
            'price' => [
                0 => '600',
                1 => '400',
            ],
        ])->assertRedirect(route('home'));
    }

    public function loginUser(User $user)
    {
        Auth::login($user);
    }
}
