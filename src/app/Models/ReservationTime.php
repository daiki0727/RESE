<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReservationTime extends Model
{
    use HasFactory;

    protected $fillable = ['time_slot'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getFormattedTimeSlotAttribute()
    {
        return Carbon::createFromFormat('H:i:s', $this->time_slot)->format('H:i');
    }
}
