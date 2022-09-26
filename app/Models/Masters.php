<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masters extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'surname', 'phone_number', 'social_media', 'images', 'information',
    ];

    public function masters()
    {
        return $this->belongsTo(Masters::class);
    }
}
