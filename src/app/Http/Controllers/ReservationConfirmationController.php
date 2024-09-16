<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationConfirmationController extends Controller
{
    public function index()
    {
        $user =Auth::user();
        $shopIds = $user->shops->pluck('id');

        $reservations = Reservation::with(['user', 'shop', 'reservationTime', 'reservationNumber'])
        ->whereIn('shop_id', $shopIds)
        ->get();

        return view('reservation_confirmation', compact('reservations'));
    }
}