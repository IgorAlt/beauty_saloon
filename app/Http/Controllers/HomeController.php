<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $user = Auth::user();
        $userAppointmentsPast = Appointment::query()->where('email', $user->email)
            ->where('appointment_time', '<', Carbon::today()->toDateTimeString())->get();
        $userAppointmentsFuture = Appointment::query()->where('email', $user->email)
            ->where('appointment_time', '>=', Carbon::today()->toDateTimeString())->get();
        $scorePast = 0;
        $scoreFuture = 0;
        return view('home', [
            'user' => $user,
            'userAppointmentsPast' => $userAppointmentsPast,
            'userAppointmentsFuture' => $userAppointmentsFuture,
            'scorePast' => $scorePast,
            'scoreFuture' => $scoreFuture
        ]);
    }

    /**Отображает форму изменения данных пользователя
     * @return View
     */
    public function change(User $user): View
    {
        return view('user_change', [
            'user' => $user
        ]);
    }

    /**
     * Пользователь изменяет свои данные
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update([
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
        ]);

        return redirect()->route('home');
    }

    /**
     * Пользователь удаляет свою запись
     * @param  Appointment  $userAppointmentsFuture
     *
     * @return RedirectResponse
     */
    public function destroy(Appointment $userAppointmentsFuture): RedirectResponse
    {
        $userAppointmentsFuture->delete();

        return redirect()->route('home');
    }
}
