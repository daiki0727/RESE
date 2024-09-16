<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    //店舗代表者作成画面表示
    public function index()
    {
        $shops = shop::all();
        return view('admin', compact('shops'));
    }

    public function createRepresentative(AdminRequest $request)
    {
        //店舗代表者作成機能
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('role_name', '店舗代表者')->first();
        $user->roles()->attach($role, ['shop_id' => $request->shop_id]);

        return redirect()->route('admin.index')->with('success', '店舗代表者が作成されました。');
    }
}
