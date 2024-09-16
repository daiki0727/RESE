@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks__container">
        <p class="thanks__message">ご予約ありがとうございます</p>
        <a class="back-btn" href="{{ route('shop.all') }}">戻る</a>
    </div>
@endsection
