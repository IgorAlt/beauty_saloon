<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    /**
     * comment
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

        return view('appointment', compact('appointmentsBusy'));
    }

    /**
     * comment
     * @param AppointmentRequest $appointmentRequest
     *
     * @return RedirectResponse
     */
    public function createAppointment(AppointmentRequest $appointmentRequest): RedirectResponse
    {
        Appointment::query()->create([
            'name' => $appointmentRequest->name,
            'surname' => $appointmentRequest->surname,
            'phone_number' => $appointmentRequest->phone,
            'email' => $appointmentRequest->email,
            'appointment_time' => $appointmentRequest->date,
        ]);

        Mail::to($appointmentRequest->email)
            ->send(new \App\Mail\Appointment($appointmentRequest->name, $appointmentRequest->date));

        Session::flash('success', 'Вы записались на приём!');

        return redirect()->route('main');
    }
}
