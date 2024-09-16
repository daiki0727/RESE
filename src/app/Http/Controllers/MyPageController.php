<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\ReservationTime;
use App\Models\ReservationNumber;
use Carbon\Carbon;

class MyPageController extends Controller
{
    // マイページの表示、お気に入り店舗表示
    public function show()
    {
        $user = auth()->user();
        $favoriteShops = Favorite::where('user_id', $user->id)
            ->with('shop.area', 'shop.genre')
            ->get();

        $now = Carbon::now();

        $reservations = Reservation::where('user_id', $user->id)
            ->where(function ($query) use ($now) {
                // 今日より後の日付の予約
                $query->where('reservation_date', '>', $now->format('Y-m-d'))
                    // もしくは、今日で現在の時間より後の予約
                    ->orWhere(function ($query) use ($now) {
                        $query->where('reservation_date', '=', $now->format('Y-m-d'))
                            ->whereHas('reservationTime', function ($query) use ($now) {
                                $query->where('time_slot', '>', $now->format('H:i:s'));
                            });
                    });
            })
            ->with('shop', 'reservationTime', 'reservationNumber')
            ->orderBy('reservation_date', 'asc')
            ->orderBy(ReservationTime::select('time_slot')
                ->whereColumn('reservation_times.id', 'reservations.reservation_time_id'), 'asc')
            ->get();

        $timeSlots = ReservationTime::all();
        $numbers = ReservationNumber::all();
        $today = $now->format('Y-m-d');

        return view('my_page', compact('favoriteShops', 'reservations', 'timeSlots', 'numbers', 'today'));
    }

    //キャンセル機能
    public function cancelReservation(Request $request)
    {
        $reservationId = $request->input('reservation_id');
        $reservation = Reservation::find($reservationId);

        if ($reservation && $reservation->user_id == auth()->id()) {
            $reservation->delete();
        }

        return redirect()->route('mypage');
    }

    //予約情報変更機能
    public function updateReservation(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);

        $reservation->update([
            'reservation_date' => $request->date,
            'reservation_time_id' => $request->time,
            'reservation_number_id' => $request->number,
        ]);

        return redirect()->route('mypage')->with('success', '予約が変更されました。');
    }
}
