<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'surname', 'phone_number', 'email', 'appointment_time'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
