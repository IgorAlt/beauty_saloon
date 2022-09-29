<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointmentsBusy = Appointment::where('appointment_time', '>=', Carbon::today()->toDateTimeString())->get();

        return view('appointment', compact('appointmentsBusy'));
    }

    public function createAppointment(Request $request)
    {
        $data = $request->validate([
           'name' => 'required|string|max:10',
           'surname' => 'required|string|max:20',
           'phone' => 'required|string|max:20',
            'email' => 'required|string|max:30',
            'date' => 'required|unique:appointments,appointment_time|after:today'
        ]);

        Appointment::create([
           'name' => $data['name'],
           'surname' => $data['surname'],
           'phone_number' => $data['phone'],
           'email' => $data['email'],
           'appointment_time' => $data['date'],
        ]);

        Mail::to($request['email'])->send(new \App\Mail\Appointment($request['name'], $request['date']));

        Session::flash('success', 'Вы записались на приём!');

        return redirect()->route('main');
    }
}
