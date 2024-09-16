@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/shop_detail.css') }}">
@endsection

@section('content')
    @php
        $previousUrl = session('previous_url', route('shop.all'));
        $averageRating = round($shop->ratings->avg('rate'));
    @endphp
    <div class="shop-detail__container">
        <div class="left__inner">
            <div class="detail__heading">
                <a class="back-btn" href="{{ $previousUrl }}">&lt;</a>
                @if ($shop)
                    <h2 class="shop__name">{{ $shop->shop_name }}</h2>
                    <a class="comments-btn" href="{{ route('comments.index', $shop->id) }}">口コミ一覧</a>
            </div>
            @if ($shop->image)
                <img class="detail__img" src="{{ asset('storage/shopimage/' . $shop->image) }}"
                    alt="{{ $shop->shop_name }}">
            @endif
            <div class="shop__content-tag">
                <p class="shop__content-tag--area">#{{ $shop->area->area_name }}</p>
                <p class="shop__content-tag--genre">#{{ $shop->genre->genre_name }}</p>
                <p class="shop__content-tag--rating">#平均評価:{{ $averageRating }}</p>
                <p class="star">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($averageRating >= $i)
                            <span class="full-star">★</span>
                        @else
                            <span class="empty-star">★</span>
                        @endif
                    @endfor
                </p>
            </div>
            <p class="shop__content-comment">{{ $shop->detail }}</p>
        @else
            <p>No shop found.</p>
            @endif
        </div>
        <div class="right__inner">
            <div class="reservation__container">
                <h3 class="reservation__heading">予約</h3>
                @livewire('reservation-form', ['shop' => $shop, 'reservationTimes' => $reservationTimes, 'numbers' => $numbers])
            </div>
        </div>
    </div>
@endsection
