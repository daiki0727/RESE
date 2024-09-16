@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="create-shop-manager__inner">
        <h2 class="create-shop-manager__hedding">店舗代表者作成</h2>
        <form class="create-shop-manager__form" action="{{ route('admin.createRepresentative') }}" method="post">
            <table class="create-shop-manager__table">
                @csrf
                <tr>
                    <th>店舗代表者名：</th>
                    <td>
                        <input type="text" name="name" value="{{ old('name') }}">
                        <p class="error-message">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス：</th>
                    <td>
                        <input type="email" name="email" value="{{ old('email') }}">
                        <p class="error-message">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>パスワード：</th>
                    <td>
                        <input type="password" name="password" value="{{ old('password') }}">
                        <p class="error-message">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>パスワード（確認）：</th>
                    <td>
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                        <p class="error-message">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </p>
                    </td>
                </tr>
                <tr>
                    <th>店舗：</th>
                    <td>
                        <select class="shop__select" name="shop_id">
                            @foreach ($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <button class="create-btn">店舗代表者作成</button>
        </form>
    </div>
@endsection
