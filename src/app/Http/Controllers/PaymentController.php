<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showPaymentForm($reservation_id)
    {
        $reservation = Reservation::with('reservationTime', 'reservationNumber', 'course')
            ->find($reservation_id);

        if (!$reservation) {
            return redirect()->route('home');
        }

        return view('payment.payment_form', compact('reservation'));
    }

    public function processPayment(Request $request)
    {
        // 正しいAPIキーを設定
        \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));

        try {
            // テスト用のStripeトークンを直接設定します（通常はクライアントサイドで生成します）
            $stripeToken = 'tok_visa';

            $charge = \Stripe\Charge::create([
                "amount" => $request->amount,
                "currency" => "jpy",
                "source" => $stripeToken,
                "description" => "Payment for reservation ID:" . $request->reservation_id
            ]);

            return redirect()->route('thanks');
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}
