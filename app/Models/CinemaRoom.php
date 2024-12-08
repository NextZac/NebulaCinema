<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemaRoom extends Model
{
    use HasFactory;
    protected $table = "cinema_room";

    public function cinema() {
        return $this->belongsTo(Cinema::class);
    }
}
