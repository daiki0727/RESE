<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Shop;

class RatingController extends Controller
{
    public function index($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        return view('rating', compact('shop'));
    }

    public function store(Request $request)
    {
        Rating::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->shop_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);

        return redirect()->route('comments.index', ['shop' => $request->shop_id])->with('success', '評価を保存しました。');
    }
}
