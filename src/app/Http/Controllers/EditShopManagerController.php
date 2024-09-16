<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\area;
use App\Models\genre;
use App\Http\Requests\EditShopRequest;
use Illuminate\Support\Facades\Storage;

class EditShopManagerController extends Controller
{
    //店舗代表者画面表示
    public function index(Request $request)
    {
        $shopId = $request->query('id'); // クエリパラメータから店舗IDを取得
        $shop = Shop::with(['area', 'genre'])->find($shopId);

        if (!$shop) {
            return redirect()->route('shop.list')->with('error', '店舗が見つかりません。');
        }

        $user = Auth::user();
        if (!$user->shops->contains($shop)) {
            return redirect()->route('shop.list')->with('error', '権限がありません。');
        }

        $areas = Area::all();
        $genres = Genre::all();

        return view('edit_shop_manager', compact('shop', 'areas', 'genres'));
    }

    //店舗情報更新機能
    public function update(EditShopRequest $request)
    {
        $shop = Shop::find($request->shop_id);

        if(!$shop) {
            return redirect()->route('edit.shop.manager')->with('error', '店舗が見つかりません。');
        }

        //権限チェック
        $user = Auth::user();
        $shopIds = $user->shops->pluck('id')->toArray();
        if (!in_array($shop->id, $shopIds)) {
            return redirect()->route('edit.shop.manager')->with('error', '権限がありません。');
        }

        //画像アップロード処理
        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('public/shopimage');
            $shop->image = basename($filename);
        }

        $shop->shop_name = $request->input('shop_name');
        $shop->area_id = $request->input('area');
        $shop->genre_id = $request->input('genre');
        $shop->detail = $request->input('detail');
        $shop->save();

        return redirect()->route('edit.shop.manager')->with('success', '更新しました。');
    }   
}
