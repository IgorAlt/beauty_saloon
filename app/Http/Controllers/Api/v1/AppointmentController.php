<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**Страница с возможностью записаться на приём
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $appointmentsBusy = Appointment::query()
            ->where(
                'appointment_time',
                '>=',
                Carbon::today()->toDateTimeString()
            )->get();

        return AppointmentResource::collection($appointmentsBusy);
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
