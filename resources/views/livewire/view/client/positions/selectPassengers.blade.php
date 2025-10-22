@extends('welcome')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-6 flex justify-center">
    <div class="max-w-6xl w-full bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Selecciona los asientos de tus pasajeros</h2>

        <p class="text-gray-600 mb-6 text-center">
            Vuelo: {{ $flight->origin->origin }} → {{ $flight->destinie->destinie }}
        </p>

        <form id="passengerForm" action="{{ route('positions.storePassengers', $flight->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-6 gap-3 justify-center mb-6">
                @for ($i = 1; $i <= $flight->model_plane->capacidad; $i++)
                    @php
                        $seat = $positions->firstWhere('seat_number', 'A'.$i);
                        $isOccupied = $seat && $seat->estado === 'ocupado';
                        $isPayerSeat = $seat && $seat->user_payer_id === $userPayer->id;
                    @endphp

                    <div
                        class="seat w-14 h-14 flex items-center justify-center rounded-md font-semibold cursor-pointer transition
                            {{ $isOccupied ? 'bg-gray-400 text-white' : ($isPayerSeat ? 'bg-blue-800 text-white' : 'bg-green-600 hover:bg-green-700 text-white') }}"
                        data-seat="A{{ $i }}"
                        @if($isOccupied || $isPayerSeat) data-occupied="true" @endif
                    >
                        {{ $i }}
                    </div>
                @endfor
            </div>

            {{-- Inputs ocultos para cada pasajero --}}
            @foreach ($passengers as $key => $passenger)
                <input type="hidden" name="passenger_seats[]" id="passenger_seat_{{ $key }}">
            @endforeach

            <div class="text-center mt-4">
                <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-900 transition">
                    Confirmar asientos
                </button>
            </div>
        </form>

        @if(session('error'))
            <p class="text-red-600 text-center mt-4">{{ session('error') }}</p>
        @endif
    </div>
</div>

<script>
    const seats = document.querySelectorAll('.seat');
    const passengerCount = {{ $passengers->count() }};
    let selectedSeats = [];

    seats.forEach(seat => {
        if (!seat.dataset.occupied) {
            seat.addEventListener('click', () => {
                const seatNumber = seat.dataset.seat;

                if (selectedSeats.includes(seatNumber)) {
                    selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                    seat.classList.remove('bg-yellow-500');
                    seat.classList.add('bg-green-600');
                } else {
                    if (selectedSeats.length >= passengerCount) {
                        alert('Ya seleccionaste todos los asientos de tus pasajeros.');
                        return;
                    }
                    selectedSeats.push(seatNumber);
                    seat.classList.remove('bg-green-600');
                    seat.classList.add('bg-yellow-500');
                }

                // Actualizar inputs ocultos
                for (let i = 0; i < passengerCount; i++) {
                    const input = document.getElementById('passenger_seat_' + i);
                    input.value = selectedSeats[i] || '';
                }
            });
        }
    });

    document.getElementById('passengerForm').addEventListener('submit', e => {
        if (selectedSeats.length < passengerCount) {
            e.preventDefault();
            alert('Debes seleccionar un asiento para cada pasajero.');
        }
    });
</script>
@endsection
