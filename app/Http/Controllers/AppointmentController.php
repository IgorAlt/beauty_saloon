<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Coupon;
use App\Models\Services;
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
        $services = Services::query()->get();
        $fullPrice = 0;

        return view('appointment', [
            'appointments_busy' => $appointmentsBusy,
            'services' => $services,
            'full_price' => $fullPrice
        ]);
    }

    /**
     * Создание записи на приём
     * @param AppointmentRequest $appointmentRequest
     *
     * @return RedirectResponse
     */
    public function createAppointment(AppointmentRequest $appointmentRequest): RedirectResponse
    {
        $coupons = Coupon::query()->get();

        $user = Auth::user();
        $fullSum = 0;
        $name = '';

        foreach ($coupons as $coupon) {
            if ($coupon->users_used == Auth::user()->email){
                Session::flash('coupons_is_used', 'Купон уже был использован вами!');
                return redirect()->route('home');
            }
            if ($appointmentRequest->coupon) {
                Coupon::query()->update([
                    'users_used' => $appointmentRequest->email,
                ]);
            }
            if ($appointmentRequest->coupon === $coupon->name) {
                if (isset($coupon->user)) {
                    if (strstr($coupon->user, Auth::user()->name)) {
                        echo '1';
                    } else {
                        Session::flash('coupons_is_not_for_you', 'Купон не для вас!');
                        return redirect()->route('home');
                    }
                }

                if (isset($coupon->percent) && $coupon->percent > 0) {
                    foreach ($appointmentRequest->price as $price) {
                        $servicesNames = Services::query()->where('price', $price)->get('service');
                        foreach ($servicesNames as $serviceName) {
                            if (strstr($coupon->services, $serviceName->service)) {
                                $name .= $serviceName->service . ' Цена: ' . $price * (1 - $coupon->percent / 100) .
                                    ' ';
                                $fullSum += $price * (1 - $coupon->percent / 100);
                            } else {
                                $name .= $serviceName->service . ' Цена: ' . $price . ' ';
                                $fullSum += $price;
                            }
                        }
                    }
                }
                if (isset($coupon->discount) && $coupon->discount > 0) {
                    foreach ($appointmentRequest->price as $price) {
                        if ($price > $coupon->discount) {
                            $servicesNames = Services::query()->where('price', $price)->get('service');
                            foreach ($servicesNames as $serviceName) {
                                if (strstr($coupon->services, $serviceName->service)) {
                                    $name .= $serviceName->service . ' Цена: ' . $price - $coupon->discount . ' ';
                                    $fullSum += $price - $coupon->discount;
                                } else {
                                    $name .= $serviceName->service . ' Цена: ' . $price . ' ';
                                    $fullSum += $price;
                                }
                            }
                        }
                    }
                }
                $coupon->count--;
                $coupon->update([
                    'count' => $coupon->count,
                ]);
                if ($coupon->count === 0) {
                    Session::flash('coupons_over', 'Купоны закончились!');
                    return redirect()->route('home');
                }
            }
            if ($name != "") {
                if (strstr($name, $coupon->services)) {
                    echo '1';
                } else {
                    Session::flash('coupons_is_not_for_service', 'Купон не подходит для данной услуги!');
                    return redirect()->route('home');
                }
            }
        }
        foreach ($appointmentRequest->price as $price) {
            if (!$appointmentRequest->coupon) {
                $servicesNames = Services::query()->where('price', $price)->get('service');
                foreach ($servicesNames as $serviceName) {
                    if ($user->loyalty_level === 0) {
                        $fullSum += $price;
                        $name .= $serviceName->service . " " . $price;
                    }
                    if ($user->loyalty_level === 3) {
                        $fullSum += $price * 0.85;
                        $name .= $serviceName->service . " " . $price * 0.85;
                    } elseif
                    ($user->loyalty_level === 2) {
                        $fullSum += $price * 0.9;
                        $name .= $serviceName->service . " " . $price * 0.9;
                    } elseif
                    ($user->loyalty_level === 1) {
                        $fullSum += $price * 0.95;
                        $name .= $serviceName->service . " " . $price * 0.95;
                    }
                    $name .= ' ';
                }
            }
        }

        Appointment::query()->create([
            'name' => $appointmentRequest->name,
            'surname' => $appointmentRequest->surname,
            'phone_number' => $appointmentRequest->phone_number,
            'email' => $appointmentRequest->email,
            'appointment_time' => $appointmentRequest->appointment_time,
            'price' => $fullSum,
            'name_appointment' => $name,
        ]);

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
