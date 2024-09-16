<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected $reservationTimes;

    public function setReservationTimes($times)
    {
        $this->reservationTimes = $times;
    }

    public function rules()
    {
        $now = Carbon::now();
        return [
            'reservation_date' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:' . now()->addYear()->format('Y-m-d'),
            ],
            'reservation_time' => ['required', 'integer', function ($attribute, $value, $fail) use ($now) {
                if ($this->reservationTimes) {
                    $selectedTime = collect($this->reservationTimes)->firstWhere('id', $value);
                    if ($selectedTime) {
                        // 正確な時間スロットを取得し、reservation_dateと組み合わせてチェック
                        $reservationDate = Carbon::parse($this->reservation_date);
                        $reservationTime = Carbon::parse($selectedTime['time_slot']);
                        // 日付と時間を組み合わせて予約日時を作成
                        $reservationDateTime = $reservationDate->setTimeFrom($reservationTime);
                        // 過去の日時をチェック
                        if ($reservationDateTime->isPast()) {
                            $fail('指定された日時は過去です。');
                        }
                    }
                }
            }],
            'reservation_number' => 'required|exists:reservation_numbers,id',
            'selected_course' => 'required|exists:courses,id',
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '＊予約日を選択してください。',
            'reservation_date.date' => '＊有効な日付を選択してください。',
            'reservation_date.after_or_equal' => '＊予約日は本日以降の日付を選択してください。',
            'reservation_date.before_or_equal' => '＊予約日は一年以内の日付を選択してください。',
            'reservation_time.required' => '＊予約時間を選択してください。',
            'reservation_time.exists' => '＊有効な予約時間を選択してください。',
            'reservation_number.required' => '＊予約人数を選択してください。',
            'reservation_number.exists' => '＊有効な予約人数を選択してください。',
            'selected_course.required' => '＊コースを選択してください。',
            'selected_course.exists' => '＊有効なコースを選択してください。',
        ];
    }
}
