<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentAdminController extends Controller
{
    /**
     * Отображение главной страницы изменения записей
     *
     * @return View
     */
    public function index(): View
    {
        $appointments = Appointment::query()
            ->get();

        return view('appointments_admin', [
            'appointments' => $appointments
        ]);
    }

    /**
     * Отображение формы изменения записей
     * @param  Appointment  $appointments_admin
     *
     * @return View
     */
    public function edit(Appointment $appointments_admin): View
    {
        return view('appointments_admin_form', [
            'appointments_admin' => $appointments_admin,
        ]);
    }

    /**
     * Изменение формы
     * @param  Request  $request
     * @param  Appointment  $appointments_admin
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Appointment $appointments_admin): RedirectResponse
    {
        $appointments_admin->update([
           'isNow_show' => $request->isNow_show,
        ]);

        $user = User::all()->where('email', $appointments_admin->email);
        $userFullSum = $user[0]->full_sum;
        $userAppointmentsPast = Appointment::query()->where('email', $user[0]->email)
            ->where('appointment_time', '<', Carbon::today()->toDateTimeString())->get();
        foreach ($userAppointmentsPast as $userAppointmentPast) {
            if ($userAppointmentPast->isNow_show === 1) {
                $userFullSum += $userAppointmentPast->price;
            }
        }
        User::query()->where('email', $appointments_admin->email)->update([
            'full_sum' => $userFullSum,
        ]);
        User::query()->where('full_sum', '>=', 5000)->update([
            'loyalty_level' => 1,
        ]);
        User::query()->where('full_sum', '>=', 10000)->update([
            'loyalty_level' => 2,
        ]);
        User::query()->where('full_sum', '>=', 15000)->update([
            'loyalty_level' =>3,
        ]);

        $appointments_admin->update([
            'isNow_show' => $request->isNow_show + 1,
        ]);

        return redirect()->route('appointments_admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
