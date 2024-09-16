<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $user_id = Auth::id();
        $shop_id = $request->input('shop_id');

        $favorite = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->first();

        if($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id
            ]);
        }
        // リダイレクト時に検索条件をクエリパラメータとして渡す
        return redirect()->back();
    }
}
