<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'reservation_date',
        'reservation_time_id',
        'reservation_number_id',
        'course_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function reservationNumber()
    {
        return $this->belongsTo(ReservationNumber::class);
    }

    public function reservationTime()
    {
        return $this->belongsTo(ReservationTime::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
