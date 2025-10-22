@extends('welcome')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10 px-6 flex justify-center">
        <div class="max-w-7xl w-full bg-white rounded-2xl shadow-lg p-6 flex gap-6">

            {{-- 🔹 Izquierda: Información y pasajeros --}}
            <div class="w-1/3 border-r border-gray-200 pr-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Vuelo</h2>
                <p class="text-gray-700 mb-6">
                    {{ $flight->origin->origin }} → {{ $flight->destinie->destinie }}<br>
                    Fecha y hora: {{ \Carbon\Carbon::parse($flight->dateHour)->format('d/m/Y H:i') }}<br>
                    Capacidad: {{ $flight->model_plane->capacidad }} asientos
                </p>

                <h3 class="text-lg font-semibold text-gray-800 mb-2">Pasajeros</h3>
                <ul class="list-disc list-inside text-gray-700">
                    @foreach ($passengers as $passenger)
                        <li>{{ $passenger->first_name }} {{ $passenger->first_surname }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- 🔹 Derecha: Mapa de asientos --}}
            <div class="w-2/3">
                <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Selecciona los asientos</h2>

                <form id="passengerForm" action="{{ route('positions.storePassengers', $flight->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-6 gap-3 justify-center mb-6">
                        @foreach ($positions as $seat)
                            @php
                                $isOccupied = $seat->estado === 'ocupado';
                                $isPayerSeat = $seat->user_payer_id === $userPayer->id;
                            @endphp

                            <div class="seat w-14 h-14 flex items-center justify-center rounded-md font-semibold cursor-pointer transition
                {{ $isOccupied ? 'bg-gray-400 text-white' : ($isPayerSeat ? 'bg-blue-800 text-white' : 'bg-green-600 hover:bg-green-700 text-white') }}"
                                data-seat="{{ $seat->seat_number }}"
                                @if ($isOccupied || $isPayerSeat) data-occupied="true" @endif>
                                {{ $seat->seat_number }}
                            </div>
                        @endforeach
                    </div>


                    {{-- Inputs ocultos para cada pasajero --}}
                    @foreach ($passengers as $key => $passenger)
                        <input type="hidden" name="passenger_seats[]" id="passenger_seat_{{ $key }}">
                    @endforeach

                    <div class="text-center mt-4">
                        <button type="submit"
                            class="bg-blue-800 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-900 transition">
                            Confirmar asientos
                        </button>
                    </div>
                </form>

                @if (session('error'))
                    <p class="text-red-600 text-center mt-4">{{ session('error') }}</p>
                @endif
            </div>
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
