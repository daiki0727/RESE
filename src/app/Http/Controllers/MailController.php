<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ShopMail;
use App\Models\User;

class MailController extends Controller
{

    public function showMail()
    {
        $user = Auth::user();

        $shopIds = $user->shops->pluck('id')->toArray();
        if (empty($shopIds)) {
            return redirect('/')->with('error', 'このページにアクセスする権限がありません。');
        }

        $shop = $user->shops->first();
        $users = User::all();

        return view('mails.send_mail', compact('user', 'shop', 'users'));
    }

    public function sendMail(Request $request)
    {
        $user = Auth::user();
        $subject = $request->input('subject');
        $body = $request->input('body');
        $recipientIds = $request->input('recipients'); // 選択されたユーザーID
        $sendToAll = in_array('all', $recipientIds); // 全員に送信するかどうか

        $successMessage = 'メールが送信されました';

        // 選択された名前の取得
        $names = [];
        if ($sendToAll) {
            $names[] = '全員に送信';
        } else {
            $users = User::whereIn('id', $recipientIds)->get();
            foreach ($users as $user) {
                $names[] = $user->name;
            }
        }

        // メール送信処理
        try {
            if ($sendToAll) {
                // 全員に送信
                $users = User::all();
            } else {
                // 選択されたユーザーに送信
                $users = User::whereIn('id', $recipientIds)->get();
            }

            foreach ($users as $recipient) {
                Mail::to($recipient->email)->send(new ShopMail(
                    $recipient->name, // 受取人の名前
                    $user->email,     // 送信元メールアドレス
                    $user->name,      // 送信元名
                    $subject,         // 件名
                    $body             // 本文
                ));
            }
        } catch (\Exception $e) {
            // エラーが発生した場合の処理
            // エラーが発生しても成功メッセージを表示
            $successMessage = 'メール送信に一部エラーが発生しましたが、他のメールは送信されました。';
        }

        // 名前をセッションに保存
        $selectedNames = implode(', ', $names);
        return redirect()->route('send.mail')->with('success', $successMessage)->with('selected_names', $selectedNames);
    }

}
