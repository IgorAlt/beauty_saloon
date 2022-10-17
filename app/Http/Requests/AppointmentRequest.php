<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string name
 * @property string surname
 * @property string phone
 * @property string email
 * @property string date
 */
class AppointmentRequest extends FormRequest
{
    /**
     * Валидация данных записи на приём
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2','max:10'],
            'surname' => ['required', 'string', 'min:2', 'max:20'],
            'phone_number' => ['required', 'string', 'min:6','max:20'],
            'email' => ['filled', 'nullable', 'email', 'max:30'],
            'appointment_time' => ['required', 'date', 'unique:appointments,appointment_time', 'after:today'],
            'price' => ['required'],
        ];
    }
}
