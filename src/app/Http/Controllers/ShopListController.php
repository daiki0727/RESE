<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class ShopListController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $shops = $this->getUserShops(Auth::user());

            return view('shop_list', compact('shops'));
        } else {
            return redirect()->route('login');
        }
    }

    private function getUserShops($user)
    {
        return $user->shops()->with(['area', 'genre'])->get();
    }
}
