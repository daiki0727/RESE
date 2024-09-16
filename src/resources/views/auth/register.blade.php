@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
    <div class="register-form">
        <h3 class="register-form__heading">Registration</h3>
        <div class="register-form__inner">
            <form class="register-form__form" action="/register" method="post">
                @csrf
                <div class="register-form__group">
                    <img class="user-icon" src="/css/images/user_icon.png" alt="User Icon">
                    <input class="register-form__input" type="text" name="name" id="name" placeholder="Username"
                        value="{{ old('name') }}">
                </div>
                <p class="error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
                <div class="register-form__group">
                    <img class="mail_icon" src="/css/images/mail_icon.png" alt="Mail Icon">
                    <input class="register-form__input" type="email" name="email" id="email" placeholder="Email"
                        value="{{ old('email') }}">
                </div>
                <p class="error-message">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
                <div class="register-form__group">
                    <img class="password_icon" src="/css/images/password_icon.png" alt="Password Icon">
                    <input class="register-form__input" type="password" name="password" id="password"
                        placeholder="Password">
                </div>
                <p class="error-message">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
                <input class="register-form__btn" type="submit" value="登録">
            </form>
        </div>
    </div>
@endsection
