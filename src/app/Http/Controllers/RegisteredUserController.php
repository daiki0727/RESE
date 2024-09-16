<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    public function store(RegisterRequest $request)
    {
        //新規ユーザー登録処理
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //パスワードをHash化（攻撃者がPWを取得できなくする）
        ]);

        // 登録直後のメール送信
        $user->sendEmailVerificationNotification();

        // ユーザーを認証する
        Auth::login($user);

        //遷移先の指定
        return view('auth.verify-email');
    }

    public function resend(Request $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with(['status' => '確認メールを再送信しました。']);
    }
}
