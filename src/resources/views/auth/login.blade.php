@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
    <div class="login-form">
        <h3 class="login-form__heading">Login</h3>
        <div class="login-form__inner">
            <form class="login-form__form" action="/login" method="post">
                @csrf
                <div class="login-form__group">
                    <img class="mail_icon" src="/css/images/mail_icon.png" alt="Mail Icon">
                    <input class="login-form__input" type="email" name="email" id="email" placeholder="Email"
                        value="{{ old('email') }}">
                </div>
                <p class="error-message">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
                <div class="login-form__group">
                    <img class="password_icon" src="/css/images/password_icon.png" alt="Password Icon">
                    <input class="login-form__input" type="password" name="password" id="password" placeholder="Password">
                </div>
                <p class="error-message">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
                    <input class="login-form__btn" type="submit" value="ログイン">
            </form>
        </div>
    </div>
@endsection
