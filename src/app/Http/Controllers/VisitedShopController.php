<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\ReservationTime;
use App\Models\ReservationNumber;
use Carbon\Carbon;

class VisitedShopController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $favoriteShops = Favorite::where('user_id', $user->id)
            ->with('shop.area', 'shop.genre')
            ->get();

        $today = Carbon::today();

        $reservations = Reservation::where('user_id', $user->id)
        ->where('reservation_date', '<', $today)
            ->with('shop', 'reservationTime', 'reservationNumber')
            ->get();

        $timeSlots = ReservationTime::all();
        $numbers = ReservationNumber::all();

        return view('visited_shop', compact('favoriteShops', 'reservations', 'timeSlots', 'numbers', 'today'));
    }
}
