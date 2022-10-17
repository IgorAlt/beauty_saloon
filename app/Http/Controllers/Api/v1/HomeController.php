<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\UserResource;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**Личный кабинет пользователя
     *
     * @return JsonResponse
     */
    public function index(LoginRequest $loginRequest): JsonResponse
    {
        $user = User::query()->where('email', $loginRequest->email)->first();
        $userAppointmentsPast = Appointment::query()->where('email', $user->email)
            ->where('appointment_time', '<', Carbon::today()->toDateTimeString())->get();
        $userAppointmentsFuture = Appointment::query()->where('email', $user->email)
            ->where('appointment_time', '>=', Carbon::today()->toDateTimeString())->get();
        $scorePast = 0;
        $scoreFuture = 0;

        return response()->json([
            'data' => [
                'user_appointments_past' => AppointmentResource::collection($userAppointmentsPast),
                'user_appointments_future' => AppointmentResource::collection($userAppointmentsFuture),
                'score_past' => $scorePast,
                'score_future' => $scoreFuture,
            ],
        ]);
    }

    public function destroy(Appointment $userAppointmentsFuture): JsonResponse
    {
        $userAppointmentsFuture->delete();

        return response()->json([
            'status' => true,
            'message' => "Запись успешно удалена",
        ]);
    }
}
