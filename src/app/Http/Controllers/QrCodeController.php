<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;

class QrCodeController extends Controller
{
    public function generate($id)
    {
        //予約情報を取得
        $reservation = Reservation::findOrFail($id);

        //予約データをJSON形式でエンコード
        $text = json_encode([
        'Shop' => $reservation->shop->shop_name,
        'Date' => $reservation->reservation_date,
        'Time' => $reservation->reservationTime->time_slot,
        'Number' => $reservation->reservationNumber->number,
        ], JSON_UNESCAPED_UNICODE);//UTF-8エンコーディングを使用

        //QRコードを生成
        $qrCode = QrCode::encoding('UTF-8')->size(300)->generate($text);

        return response($qrCode)->header('Content-Type', 'image/svg+xml');
    }
}
