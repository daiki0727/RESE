<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopRequest;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\UserShopRole;
use Illuminate\Support\Facades\Auth;

class CreateShopManagerController extends Controller
{
    //店舗代表者画面表示
    public function index()
    {
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();
        return view('create_shop_manager', compact('shops', 'areas', 'genres'));
    }

    //新規店舗作成処理
    public function store(CreateShopRequest $request)
    {
        //データベースに保存
        $shop = new shop();
        $shop->shop_name = $request->input('shop_name');
        $shop->area_id = $request->input('area');
        $shop->genre_id = $request->input('genre');
        $shop->detail = $request->input('detail');

        //ファイルアップロード処理
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('public/shopimage');
            $shop->image = basename($filename);
            $shop->save();

            //現在のユーザーを店舗代表者としてuser_shop_role_tableへ保存
            $userShopRole = new UserShopRole();
            $userShopRole->user_id = Auth::id();
            $userShopRole->shop_id = $shop->id;
            $userShopRole->role_id = 2;
            $userShopRole->save();

            return redirect()->route('create.shop.manager')->with('success', '店舗情報が保存されました！');
        }
    }
}
