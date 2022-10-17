<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\ServiceResource;
use App\Models\Appointment;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**Страница с возможностью записаться на приём
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $appointmentsBusy = Appointment::query()
            ->where(
                'appointment_time',
                '>=',
                Carbon::today()->toDateTimeString()
            )->get();
        $services = Services::query()->get();
        $fullPrice = 0;

        return response()->json([
            'appointment_resource' => AppointmentResource::collection($appointmentsBusy),
            'services' => ServiceResource::collection($services),
            'full_price' => $fullPrice,
        ]);
    }

    public function create(AppointmentRequest $appointmentRequest): JsonResponse
    {
        Appointment::query()->create($appointmentRequest->validated());

        Mail::to($appointmentRequest->email)
            ->send(new \App\Mail\Appointment($appointmentRequest->name, $appointmentRequest->date));

        return response()->json([
            'status' => true,
            'message' => "Данные успешно сохранены",
        ]);
    }
}
