<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class CommentsIndexController extends Controller
{
    public function index(Shop $shop)
    {
        $ratings = $shop->ratings;

        return view('comments_index', compact('shop', 'ratings'));
    }
}
