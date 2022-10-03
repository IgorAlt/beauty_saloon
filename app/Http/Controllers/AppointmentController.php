<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    /**
     * Запись на приём
     *
     * @return View
     */
    public function index(): View
    {
        $appointmentsBusy = Appointment::query()
            ->where(
                'appointment_time',
                '>=',
                Carbon::today()->toDateTimeString()
            )->get();

        return view('appointment', ['appointments_busy' => $appointmentsBusy]);
    }

    /**
     * Создание записи на приём
     * @param AppointmentRequest $appointmentRequest
     *
     * @return RedirectResponse
     */
    public function createAppointment(AppointmentRequest $appointmentRequest): RedirectResponse
    {
        Appointment::query()->create($appointmentRequest->validated());

        Mail::to($appointmentRequest->email)
            ->send(new \App\Mail\Appointment($appointmentRequest->name, $appointmentRequest->date));

        Session::flash('success', 'Вы записались на приём!');

        if (Auth::user()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('main');
        }
    }
}
