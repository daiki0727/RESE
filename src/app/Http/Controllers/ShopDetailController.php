<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Course;
use App\Models\Genre;
use App\Models\ReservationTime;
use App\Models\ReservationNumber;


class ShopDetailController extends Controller
{
    public function show(Request $request, $shop_id)
    {
        //遷移元のURLをセッションに保存
        if ($request->headers->has('referer')){
            $previousUrl = $request->headers->get('referer');
            if(strpos($previousUrl, route('mypage')) !== false) {
                //マイページから遷移した場合
            Session::put('previous_url', route('mypage'));
        } else if (strpos($previousUrl, route('shop.search')) !== false){
            //検索結果から遷移した場合
            Session::put('previous_url', route('shop.search.get'));
        } else {
            //そのまま遷移した場合
            Session::put('previous_url', route('shop.all'));
        }
    }
        
        //店舗に基づいたデータの取得(押下した特定の店舗の情報表示)
        $shop = Shop::with(['area', 'genre'])->findOrFail($shop_id);
        $areas = Area::all();
        $genres = Genre::all();
        $numbers = ReservationNumber::all();
        $reservationTimes = ReservationTime::all();
        $courses = Course::all();

        return view('shop_detail', compact('shop', 'areas', 'genres', 'numbers', 'reservationTimes'));
    }

    public function thanks()
    {
        return view('thanks');
    }
}
