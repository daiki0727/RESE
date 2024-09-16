@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
    <div class="mypage__container">
        <div class="head__inner">
            <h1 class="name__heading">{{ auth()->user()->name }}&nbsp;さん</h1>
            <a class="visited-shop-btn" href="{{ route('visited.shop') }}">訪店店舗一覧</a>
        </div>
        <div class="left__inner">
            <h2 class="reservation__heading">予約状況</h2>
            @foreach ($reservations as $reservation)
                <div class="reservation-inner">
                    <div class="reservation__upper">
                        <img class="clock-icon" src="/css/images/clock_icon.png" alt="Clock Icon">
                        <span class="reservation__number">予約{{ $reservation->id }}</span>
                        <form class="cancel__form" action="{{ route('cancel.reservation') }}" method="post">
                            @csrf
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <button class="cancel-btn">×</button>
                        </form>
                    </div>
                    <table class="reservation__table">
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
                    <div class="btn-box">
                        <a class="qr-btn" href="{{ url('/qrcode/' . $reservation->id) }}" target="_blank">QRコード</a>
                        <a class="edit-btn" href="#{{ $reservation->id }}">変更</a>
                    </div>
                    <!-- モーダルウィンドウ -->
                    <div id="{{ $reservation->id }}" class="modal">
                        <div class="modal-content">
                            <a href="#" class="close-modal">×</a>
                            <h2 class="edit-reservation__heading">予約内容の変更</h2>
                            <form class="edit-reservation__form" action="{{ route('update.reservation') }}" method="post">
                                @csrf
                                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                <table class="modal__table">
                                    <tr>
                                        <th>Date:</th>
                                        <td>
                                            <input class="modal-input" type="date" name="date"
                                                value="{{ $reservation->reservation_date }}" min="{{ $today }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Time:</th>
                                        <td>
                                            <select class="modal-select" name="time">
                                                @foreach ($timeSlots as $slot)
                                                    <option value="{{ $slot->id }}"
                                                        {{ $reservation->reservationTime->id == $slot->id ? 'selected' : '' }}>
                                                        {{ $slot->time_slot }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Number</th>
                                        <td>
                                            <select class="modal-select" name="number">
                                                @foreach ($numbers as $number)
                                                    <option value="{{ $number->id }}"
                                                        {{ $reservation->reservationNumber->id == $number->id ? 'selected' : '' }}>
                                                        {{ $number->number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <button class="upadate-btn" type="submit">変更を保存</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="right__inner">
            <h2 class="favorite__heading">お気に入り店舗</h2>
            <div class="card__inner">
                @foreach ($favoriteShops as $favoriteShop)
                    <div class="card">
                        <div class="card__img">
                            <img src="{{ asset('storage/shopimage/' . $favoriteShop->shop->image) }}"
                                alt="{{ $favoriteShop->shop->shop_name }}">
                        </div>
                        <div class="card__content">
                            <div class="card__content-shop">{{ $favoriteShop->shop->shop_name }}</div>
                            <div class="card__content-tag">
                                <p class="card__content-tag--area">#{{ $favoriteShop->shop->area->area_name }}</p>
                                <p class="card__content-tag--genre">#{{ $favoriteShop->shop->genre->genre_name }}</p>
                            </div>
                            <div class="card__btn">
                                <a class="detail-btn"
                                    href="{{ route('shop.detail', ['shop_id' => $favoriteShop->shop->id]) }}">詳しくみる</a>
                                <div class="favorite-container">
                                    @if (Auth::check())
                                        <form action="{{ route('favorite.toggle') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="shop_id" value="{{ $favoriteShop->shop->id }}">
                                            <button type="submit"
                                                class="favorite-btn {{ $favoriteShop->shop->isFavorited() ? 'favorited' : '' }}">
                                                <i class="fa-sharp fa-solid fa-heart"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
