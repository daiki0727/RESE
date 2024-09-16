@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create_shop_manager.css') }}">
@endsection

@section('content')
    <div class="create-shop-data__inner">
        <h2 class="create-shop-data__hedding">新規店舗作成</h2>
        <form class="create-shop-data__form" action="{{ route('store.shop.manager') }}" method="post"
            enctype="multipart/form-data">
            <table class="create-shop-data__table">
                @csrf
                <tr>
                    <th>店舗名：</th>
                    <td>
                        <input type="text" name="shop_name" value="{{ old('shop_name') }}">
                        <p class="error-message">
                            @error('shop_name')
                                {{ $message }}
                            @enderror
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>店舗画像：</th>
                    <td>
                        <input type="file" name="image">
                        <p class="error-message">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>エリア：</th>
                    <td>
                        <select class="area-select" name="area" id="area">
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ session('area') == $area->id ? 'selected' : '' }}>
                                    {{ $area->area_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>ジャンル：</th>
                    <td>
                        <select class="genre-select" name="genre" id="genre">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ session('genre') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->genre_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>店舗紹介内容：</th>
                    <td>
                        <textarea type="text" name="detail">{{ old('detail') }}</textarea>
                        <p class="error-message">
                            @error('detail')
                                {{ $message }}
                            @enderror
                        </p>
                    </td>
                </tr>
            </table>
            <button class="create-btn">店舗情報作成</button>
        </form>
    </div>
@endsection
