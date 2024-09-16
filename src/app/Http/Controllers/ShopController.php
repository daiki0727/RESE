<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    //ホーム画面表示(認証不要)
    public function indexPublic()
    {
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();
        $isLoggedIn = false;

        return view('shop_all', compact('shops', 'areas', 'genres', 'isLoggedIn'));
    }

    //ホーム画面表示(認証済ユーザー)
    public function index()
    {
        $shops = Shop::with(['area', 'genre'])->get();
        $areas = Area::all();
        $genres = Genre::all();
        $isLoggedIn = Auth::check();

        return view('shop_all', compact('shops', 'areas', 'genres', 'isLoggedIn'));
    }

    //検索機能
    public function search(Request $request)
    {
        //各検索条件取得
        $area = $request->input('area');
        $genre = $request->input('genre');
        $search = $request->input('search');

        // 検索条件をセッションに保存
        $request->session()->put('area', $area);
        $request->session()->put('genre', $genre);
        $request->session()->put('search', $search);

        //クエリビルダーの使用
        $query = Shop::query();

        //エリアの条件を追加（エリアが選択されている場合、area_idと一致するレコードを検索条件に追加）
        if(!empty($area)) {
            $query->where('area_id', $area);
        }

        //ジャンルの条件を追加（ジャンルが選択されている場合、genre_idと一致するレコードを検索条件に追加）
        if (!empty($genre)) {
            $query->where('genre_id', $genre);
        }

        //エリアの条件を追加（検索キーワードが入力されている場合、shop_nameと一致するレコードを検索条件に追加）
        if (!empty($search)) {
            $query->where('shop_name', 'LIKE', "%{$search}%");
        }

        //結果取得（shopモデルに関するareaとgenreを一緒に取得）
        $shops = $query->with(['area', 'genre'])->get();
        //検索後、再度検索条件を変更して検索できるようにするための全件取得
        $areas = Area::all();
        $genres = Genre::all();

        $isLoggedIn = Auth::check();

        return view('shop_all', compact('shops', 'areas', 'genres', 'isLoggedIn'));
    }

    //条件検索時セッション保存
    public function searchBySession(Request $request)
    {
        //各検索条件取得
        $area = session('area');
        $genre = session('genre');
        $search = session('search');

        //クエリビルダーの使用
        $query = Shop::query();

        //エリアの条件を追加（エリアが選択されている場合、area_idと一致するレコードを検索条件に追加）
        if (!empty($area)) {
            $query->where('area_id', $area);
        }

        //ジャンルの条件を追加（ジャンルが選択されている場合、genre_idと一致するレコードを検索条件に追加）
        if (!empty($genre)) {
            $query->where('genre_id', $genre);
        }

        //エリアの条件を追加（検索キーワードが入力されている場合、shop_nameと一致するレコードを検索条件に追加）
        if (!empty($search)) {
            $query->where('shop_name', 'LIKE', "%{$search}%");
        }

        //結果取得（shopモデルに関するareaとgenreを一緒に取得）
        $shops = $query->with(['area', 'genre'])->get();
        //検索後、再度検索条件を変更して検索できるようにするための全件取得
        $areas = Area::all();
        $genres = Genre::all();

        $isLoggedIn = Auth::check();

        return view('shop_all', compact('shops', 'areas', 'genres', 'isLoggedIn'));
    }

    
}
