@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">
@endsection

@section('content')
    <div class="search-form">
        <div class="search-form__inner">
            <form class="shop-search" action="{{ route('shop.search') }}" method="POST">
                @csrf
                <select class="area-select" name="area" id="area">
                    <option value="">All area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ session('area') == $area->id ? 'selected' : '' }}>{{ $area->area_name }}</option>
                    @endforeach
                </select>
                <select class="genre-select" name="genre" id="genre">
                    <option value="">All genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ session('genre') == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
                    @endforeach
                </select>
                <button class="search-btn" type="submit">
                    <img class="search-icon" src="/css/images/search_icon.png" alt="Search Icon">
                </button>
                <input class="shop-search__input" type="search" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
    <div class="card__inner">
        @foreach ($shops as $shop)
            <div class="card">
                <div class="card__img">
                    @if ($shop->image)
                        <img src="{{ asset('storage/shopimage/' . $shop->image) }}" alt="{{ $shop->shop_name }}">
                    @endif
                </div>
                <div class="card__content">
                    <div class="card__content-shop">{{ $shop->shop_name }}</div>
                    <div class="card__content-tag">
                        <p class="card__content-tag--area">#{{ $shop->area->area_name }}</p>
                        <p class="card__content-tag--genre">#{{ $shop->genre->genre_name }}</p>
                    </div>
                    <div class="card__btn">
                        <a class="detail-btn" href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}">詳しくみる</a>
                        <div class="favorite-container">
                            @if (Auth::check())
                                <form action="{{ route('favorite.toggle') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    <button type="submit" class="favorite-btn {{ $shop->isFavorited() ? 'favorited' : '' }}">
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
@endsection
