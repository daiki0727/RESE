@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/comments_index.css') }}">
@endsection

@section('content')
    <div class="comments__container">
        <a class="back-btn" href="{{ route('shop.detail', $shop->id) }}">&lt;</a>
        <h2 class="comments-heading">{{ $shop->shop_name }}&nbsp;の口コミ一覧</h2>
        <div class="comments__inner">
            @foreach ($shop->ratings as $rating)
                <div class="comments__box">
                    <table class="comments__table">
                        <tr>
                            <th>評価</th>
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
                            <th>コメント</th>
                            <td>{{ $rating->comment }}</td>
                        </tr>
                        <tr>
                            <th>投稿者</th>
                            <td>{{ $rating->user->name }}</td>
                        </tr>
                        <tr>
                            <th>投稿日</th>
                            <td>{{ $rating->created_at }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@endsection
