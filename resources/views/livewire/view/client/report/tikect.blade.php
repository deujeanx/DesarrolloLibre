@extends('welcome')
@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3x1 font-bold text-gray-800 mb-6">Facturas De Tickets</h1>

    @if (Session::has('alert'))
        <script>
            // Convierte el array de PHP a un objeto JSON
            const alertData = @json(session('alert'));

            // Llama a SweetAlert2 con los datos recibidos
            Swal.fire({
                icon: alertData.icon,
                title: alertData.title,
                text: alertData.text,
            });
        </script>
    @endif

    @foreach ($tickets as $ticket)

        <div class="border rounded-xl shadow-lg p-6 mb-8 bg-white">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Reserva Electronica</h2>
                    <p class="text-sm text-gray-500">Fecha: {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-medium text-gray-700">Ticket #{{$ticket->token }}</p>
                </div>
            </div>

            {{-- datos del vuelo --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="font-semibold text-gray-600">Origen:</p>
                    <p class="text-gray-800">{{ $ticket->flight->origin->origin }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Destino:</p>
                    <p class="text-gray-800">{{ $ticket->flight->destinie->destinie }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Cantidad de pasajeros</p>
                    <p class="text-gray-800">{{ $ticket->flight->destinie_id }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Metodo de pago:</p>
                    <p class="text-gray-800">{{$ticket->flight->userPassenger}}</p>
                </div>
            </div>

            {{-- Detalles de costos --}}
            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between mb-2">
                    <span class="font-medium text-gray-600">Valor por puesto:</span>
                    <span class="text-gray-800">$</span>
                </div>
                <div class="flex justify-between font-bold text-gray-700 text-lg">
                    <span>Valor: total:</span>
                    <span>$</span>
                </div>
            </div>
        </div>

    @endforeach
</div>
@endsection
