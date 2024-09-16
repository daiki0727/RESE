<!DOCTYPE html>
<html>
<head>
    <title>Reservation Reminder</title>
</head>
<body>
    <h1>予約のご案内</h1>
    <p>{{ $reservation->user->name }}様</p>
    <p>以下のようにご予約を承っております。</p>
    <p>店舗名:{{ $reservation->shop->name }}</p>
    <p>日時:{{ $reservation->reservation_date }}{{ $reservation->reservationTime->time }}</p>
    <p>予約人数:{{ $reservation->reservationNumber->number }}人</p>
</body>
</html>
