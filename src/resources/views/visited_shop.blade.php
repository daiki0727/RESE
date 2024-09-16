@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/visited_shop.css') }}">
@endsection

@section('content')
    <div class="visited-shop__container">
            <a class="back-btn" href="{{ route('mypage') }}">&lt;</a>
            <h2 class="visited-shop__heading">訪店店舗一覧</h2>
        <div class="visited-shop__box">
            @foreach ($reservations as $reservation)
                <div class="visited-shop__inner">
                    <div class="visited-shop__upper">
                        <img class="clock-icon" src="/css/images/clock_icon.png" alt="Clock Icon">
                    </div>
                    <table class="visited-shop__table">
                        <tr>
                            <th>Shop</th>
                            <td>{{ $reservation->shop->shop_name }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $reservation->reservation_date }}</td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>{{ $reservation->reservationTime->time_slot }}</td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <td>{{ $reservation->reservationNumber->number }}</td>
                        </tr>
                    </table>
                    <a class="rating-btn" href="{{ route('rating.index', ['shop_id' => $reservation->shop->id]) }} --}}">口コミを投稿</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
