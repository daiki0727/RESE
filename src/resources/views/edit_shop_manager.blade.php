@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit_shop_manager.css') }}">
@endsection

@section('content')
    <div class="edit-shop-manager__container">
        <a class="back-btn" href="{{ route('shop.list', ['shop' => $shop->id]) }}">&lt;</a>
        <div class="left__inner">
                <h2 class="create-review__hedding">{{ $shop->shop_name }}&nbsp;の店舗情報変更</h2>
                <form class="edit-shop-manager__form" action="{{ route('shop.update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="shop__name">
                        <input type="text" name="shop_name" value="{{ old('shop_name', $shop->shop_name) }}">
                        <p class="error-message__name">
                            @error('shop_name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="shop__image">
                        <input class="input__file" type="file" name="image">
                        <p class="error-message">
                        </p>
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        @if ($shop->image)
                            <img class="upload__image" src="{{ asset('storage/shopimage/' . $shop->image) }}"
                                alt="{{ $shop->shop_name }}">
                        @endif
                    </div>
                    <div class="area-genre__tag">
                        <p class="shop__area">
                            #&nbsp;<select class="area-select" name="area" id="area">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ old('area', $shop->area_id) == $area->id ? 'selected' : '' }}>
                                        {{ $area->area_name }}
                                    </option>
                                @endforeach
                            </select></p>
                        <p class="shop__genre">
                            #&nbsp;<select class="genre-select" name="genre" id="genre">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ old('genre', $shop->genre_id) == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->genre_name }}
                                    </option>
                                @endforeach
                            </select>
                        </p>
                    </div>
                    <div class="shop__content-comment">
                        <textarea type="text" name="detail">{{ old('detail', $shop->detail) }}</textarea>
                        <p class="error-message__detail">
                            @error('detail')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <button class="edit-btn">更新する</button>
                </form>
        </div>
        <div class="right__inner">
            <h2 class="create-review__hedding">{{ $shop->shop_name }}&nbsp;の口コミ投稿一覧</h2>
            <div class="comments__inner">
                @foreach ($shop->ratings as $rating)
                    <div class="comments__box">
                        <table class="comments__table">
                            <tr>
                                <th>評価:</th>
                                <td>
                                    {{ $rating->rate }}&nbsp;
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating->rate)
                                            <span class="gold-star">★</span>
                                        @else
                                            <span class="gray-star">★</span>
                                        @endif
                                    @endfor
                                </td>
                            </tr>
                            <tr>
                                <th>コメント:</th>
                                <td>{{ $rating->comment }}</td>
                            </tr>
                            <tr>
                                <th>投稿者:</th>
                                <td>{{ $rating->user->name }}</td>
                            </tr>
                            <tr>
                                <th>投稿日:</th>
                                <td>{{ $rating->created_at }}</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
