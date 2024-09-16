@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
@endsection

@section('content')
    <div class="create-review__inner">
        <a class="back-btn" href="{{ route('visited.shop', ['shop' => $shop->id]) }}">&lt;</a>
                <h2 class="create-review__hedding">{{ $shop->shop_name }}&nbsp;の口コミ投稿画面</h2>
                <form class="create-review__form" action="{{ route('rating.store') }}" method="post">
                    <table class="create-review__table">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <tr>
                            <th>評価：</th>
                            <td>
                                <div class="rate-form">
                                    <input id="star5" type="radio" name="rate" value="5">
                                    <label for="star5">★</label>
                                    <input id="star4" type="radio" name="rate" value="4">
                                    <label for="star4">★</label>
                                    <input id="star3" type="radio" name="rate" value="3">
                                    <label for="star3">★</label>
                                    <input id="star2" type="radio" name="rate" value="2">
                                    <label for="star2">★</label>
                                    <input id="star1" type="radio" name="rate" value="1">
                                    <label for="star1">★</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>コメント：</th>
                            <td>
                                <textarea type="text" name="comment" cols="45" rows="3"></textarea>
                            </td>
                        </tr>
                    </table>
                    <button class="create-review-btn">口コミを投稿する</button>
                </form>
    </div>
@endsection
