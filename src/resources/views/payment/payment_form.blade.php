@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment/payment_form.css') }}">
@endsection

@section('content')
    <div class="back-btn__area">
        <a class="back-btn" href="{{ session('previous_url', route('shop.detail', ['shop_id' => $reservation->shop_id])) }}">&lt;</a>
    </div>
    <div class="reservation__inner">
        <p class="reservation_heading">予約内容の確認</p>
        <table class="reservation__table">
            <tr>
                <th>Reservation Date:</th>
                <td>{{ $reservation->reservation_date }}</td>
            </tr>
            <tr>
                <th>Reservation Time:</th>
                <td>{{ $reservation->reservationTime->time_slot }}</td>
            </tr>
            <tr>
                <th>Number of People:</th>
                <td>{{ $reservation->reservationNumber->number }}</td>
            </tr>
            <tr>
                <th>Course:</th>
                <td>{{ $reservation->course->course_name }} (¥{{ $reservation->course->price }})</td>
            </tr>
        </table>
    </div>
    <div class="payment__inner">
        <p class="payment__heading">カード情報入力</p>
        <form class="payment__form" action="{{ route('payment.process') }}" method="POST">
            @csrf
            <div class="payment__box">
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <input type="hidden" name="amount" value="{{ $reservation->course->price }}">
                <div class="card__detail">
                    <label for="card_number">Card Number:</label>
                    <input type="text" id="card_number" name="card_number">
                    <p class="error-message">
                        @error('card_number')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="card__detail">
                    <label for="expiry_month">Expiry Month:</label>
                    <input type="text" id="expiry_month" name="expiry_month">
                    <p class="error-message">
                        @error('expiry_month')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="card__detail">
                    <label for="expiry_year">Expiry Year:</label>
                    <input type="text" id="expiry_year" name="expiry_year">
                    <p class="error-message">
                        @error('expiry_year')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="card__detail">
                    <label for="cvc">CVC:</label>
                    <input type="text" id="cvc" name="cvc">
                    <p class="error-message">
                        @error('cvc')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>
            <button class="pay-btn" type="submit">支払う</button>
        </form>
    </div>
@endsection
