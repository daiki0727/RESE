<div class="livewire-wrapper">
    <form class="reservation__content" wire:submit.prevent="reserve">
        @csrf
        <input class="reservation__date" type="date" name="reservation_date" min="{{ $today }}"
        value="{{ old('reservation_date', $reservation_date) }}" wire:model="reservation_date">
        <p class="error-message">
            @error('reservation_date')
                {{ $message }}
            @enderror
        </p>
        <select class="reservation__time" name="reservation_time" id="reservation__time" wire:model="reservation_time">
            <option value="" selected>時間を選択してください</option>
            @foreach ($reservationTimes as $Time)
                <option value="{{ $Time->id }}" {{ old('reservation_time', $reservation_time) == $Time->id ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::parse($Time->time_slot)->format('H:i') }}
                </option>
            @endforeach
        </select>
        <p class="error-message">
            @error('reservation_time')
                {{ $message }}
            @enderror
        </p>
        <select class="reservation__number" name="reservation_number" id="reservation__number"
            wire:model="reservation_number">
            <option value="" selected>人数を選択してください</option>
            @foreach ($numbers as $number)
                <option value="{{ $number->id }}" {{ old('reservation_number', $reservation_number) == $number->id ? 'selected' : '' }}>
                    {{ $number->number }}
                </option>
            @endforeach
        </select>
        <p class="error-message">
            @error('reservation_number')
                {{ $message }}
            @enderror
        </p>
        <select class="reservation__course" name="reservation_course" id="reservation__course"
            wire:model="selected_course">
            <option value="" selected>コースを選択してください</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" {{ old('selected_course', $selected_course) == $course->id ? 'selected' : '' }}>
                    {{ $course->course_name }} (¥{{ $course->price }})
                </option>
            @endforeach
        </select>
        <p class="error-message">
            @error('selected_course')
                {{ $message }}
            @enderror
        </p>
        <div class="confirm__reservation">
            <table class="reservation__datail">
                <tr>
                    <th>Shop</th>
                    <td>{{ $shop->shop_name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $reservation_date }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ $formattedReservationTime }}</td>

                </tr>
                <tr>
                    <th>Number</th>
                    <td>{{ $numbers->firstWhere('id', $reservation_number)->number ?? '' }}</td>
                </tr>
            </table>
        </div>
        @if (Auth::check())
            <button class="reservation-btn" type="submit">予約する</button>
        @else
            <h3 class="validation">＊ネット予約のご利用にはログイン/会員登録が必要です。</h3>
        @endif
    </form>
</div>
