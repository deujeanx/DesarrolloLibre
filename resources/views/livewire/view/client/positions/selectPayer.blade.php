@extends('welcome')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-6 flex justify-center">
    <div class="max-w-6xl w-full bg-white rounded-2xl shadow-lg p-6 flex gap-8">
        
        {{-- Información del pagador --}}
        <div class="w-1/3 border-r border-gray-200 pr-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Información del Pagador</h2>
            <div class="text-gray-700 space-y-2">
                <p><span class="font-semibold">Nombre:</span> {{ $userPayer->user->name }}</p>
                <p><span class="font-semibold">Correo:</span> {{ $userPayer->user->email }}</p>
                <p><span class="font-semibold">Rol:</span> {{ $userPayer->rol }}</p>
                <p><span class="font-semibold">Vuelo:</span> {{ $flight->origin->origin }} → {{ $flight->destinie->destinie }}</p>
            </div>
        </div>

        {{-- Asientos --}}
        <div class="w-2/3">
            <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Selecciona tu asiento</h2>

            <form id="seatForm" action="{{ route('positions.storePayer', $flight->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="seat_number" id="seat_number">

                <div class="grid grid-cols-6 gap-3 justify-center mb-6">
                    @for ($i = 1; $i <= $flight->model_plane->capacidad; $i++)
                        @php
                            $seat = $positions->firstWhere('seat_number', 'A'.$i);
                            $isOccupied = $seat && $seat->estado === 'ocupado';
                        @endphp

                        <div 
                            class="seat w-14 h-14 flex items-center justify-center rounded-md font-semibold cursor-pointer transition
                                {{ $isOccupied ? 'bg-gray-400 text-white' : 'bg-green-600 hover:bg-green-700 text-white' }}"
                            data-seat="A{{ $i }}"
                            @if($isOccupied) data-occupied="true" @endif
                        >
                            {{ $i }}
                        </div>
                    @endfor
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-900 transition">
                        Confirmar asiento
                    </button>
                </div>
            </form>

            @if (session('error'))
                <p class="text-red-600 text-center mt-4">{{ session('error') }}</p>
            @endif
            @if (session('success'))
                <p class="text-green-600 text-center mt-4">{{ session('success') }}</p>
            @endif
        </div>
    </div>
</div>

<script>
    const seats = document.querySelectorAll('.seat');
    const inputSeat = document.getElementById('seat_number');

    seats.forEach(seat => {
        if (!seat.dataset.occupied) {
            seat.addEventListener('click', () => {
                // Quitar selección anterior
                seats.forEach(s => s.classList.remove('bg-blue-800'));
                seats.forEach(s => {
                    if (!s.dataset.occupied) s.classList.add('bg-green-600');
                });

                // Marcar nuevo asiento
                seat.classList.remove('bg-green-600');
                seat.classList.add('bg-blue-800');

                // Guardar valor
                inputSeat.value = seat.dataset.seat;
            });
        }
    });

    document.getElementById('seatForm').addEventListener('submit', e => {
        if (!inputSeat.value) {
            e.preventDefault();
            alert('Por favor selecciona un asiento antes de continuar.');
        }
    });
</script>
@endsection
