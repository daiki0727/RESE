<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Http\Requests\ReservationRequest;
use App\Models\Course;

class ReservationForm extends Component
{
    public $shop;
    public $reservation_date;
    public $reservation_time;
    public $reservation_number;
    public $reservationTimes;
    public $numbers;
    public $formattedReservationTime;
    public $today;
    public $courses;
    public $selected_course;

    public function mount($shop, $reservationTimes, $numbers)
    {
        $this->shop = $shop;
        $this->reservationTimes = $reservationTimes;
        $this->numbers = $numbers;
        $this->courses = Course::all();
        $this->reservation_date = '';
        $this->reservation_time = '';
        $this->reservation_number = '';
        $this->selected_course = '';
        $this->updateFormattedReservationTime();
        $this->today = Carbon::today()->toDateString();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules());
    }

    protected function rules()
    {
        $request = new ReservationRequest();
        return $request->rules();
    }

    protected function messages()
    {
        $request = new ReservationRequest();
        return $request->messages();
    }

    public function reserve()
    {
        $this->validate($this->rules(), $this->messages());

        session(['previous_url' => url()->previous()]);

        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->shop_id = $this->shop->id;
        $reservation->reservation_date = $this->reservation_date;
        $reservation->reservation_time_id = $this->reservation_time;
        $reservation->reservation_number_id = $this->reservation_number;
        $reservation->course_id = $this->selected_course;
        $reservation->save();

        return redirect()->route('payment.form', ['reservation_id' => $reservation->id]);
    }

    public function render()
    {
        $this->updateFormattedReservationTime();
        return view('livewire.reservation-form', [
            'courses' => $this->courses,
        ]);
    }


    private function updateFormattedReservationTime()
    {
        $selectedTime = $this->reservationTimes->firstwhere('id', $this->reservation_time);
        $this->formattedReservationTime = $selectedTime ? Carbon::parse($selectedTime->time_slot)->format('H:i') : '';
    }
}
