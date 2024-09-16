@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mails/send_mail.css') }}">
@endsection

@section('content')
    <h2 class="mail__hedding">メール送信</h2>
    <div class="mail__container">
        <form class="mail__form" action="/send-mail" method="post">
            @csrf
            <div class="mail__form--inner">
                <div class="recipients__area">
                    <label class="recipients__label" for="recipients">送信先:</label>
                    <select class="recipients__select" id="recipients" name="recipients[]" multiple>
                        <option value="all">全員に送信</option>
                        @foreach ($users as $recipient)
                            <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text__area">
                    <label class="subject__label" for="subject">件名:</label>
                    <input class="subject__input" type="text" id="subject" name="subject">

                    <label class="body__label" for="body">本文:</label>
                    <textarea class="body__textarea" id="body" name="body" required></textarea>
                                <button class="mail-btn" type="submit">送信</button>

                </div>
            </div>
        </form>

    
    </div>
@endsection
