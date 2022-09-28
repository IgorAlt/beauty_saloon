<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'post', 'image'];

    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }
}
