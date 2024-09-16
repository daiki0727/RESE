@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/shop_list.css') }}">
@endsection

@section('content')
    <div class="shop-list__container">
        <h2 class="shop-list__heading">管理店舗一覧</h2>
        <div class="shop-list__inner">
            @forelse ($shops as $shop)
                <a class="shop-list__href"
                    href="{{ route('edit.shop.manager', ['id' => $shop->id]) }}">{{ $shop->shop_name }}</a>
            @empty
                <p>店舗が見つかりませんでした。</p>
            @endforelse
        </div>
    </div>
@endsection
