<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationNumber extends Model
{
    use HasFactory;

    protected $fillable = ['number'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
