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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2','max:10'],
            'surname' => ['required', 'string', 'min:2', 'max:20'],
            'phone' => ['required', 'string', 'min:6','max:20'],
            'email' => ['filled', 'nullable', 'email', 'max:30'],
            'date' => ['required', 'date', 'unique:appointments,appointment_time', 'after:today'],
        ];
    }
}
