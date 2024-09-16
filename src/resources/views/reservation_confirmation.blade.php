@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/reservation_confirmation.css') }}">
@endsection

@section('content')
    <h2 class="reservation-confirmation__heading">予約状況一覧</h2>
    <div class="reservation-confirmation__inner">
        <table class="reservation-confirmation__table">
            <tr class="reservation-confirmation__row">
                <th class="reservation-confirmation__label">予約No.</th>
                <th class="reservation-confirmation__label">ユーザー名</th>
                <th class="reservation-confirmation__label">日付</th>
                <th class="reservation-confirmation__label">時間</th>
                <th class="reservation-confirmation__label">人数</th>
            </tr>
            @foreach($reservations as $reservation)
            <tr class="reservation-confirmation__row">
                <td class="reservation-confirmation__data">{{ $reservation->id }}</td>
                <td class="reservation-confirmation__data">{{ $reservation->user->name }}</td>
                <td class="reservation-confirmation__data">{{ $reservation->reservation_date }}</td>
                <td class="reservation-confirmation__data">{{ $reservation->reservationTime->formatted_time_slot }}</td>
                <td class="reservation-confirmation__data">{{ $reservation->reservationNumber->number }}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
