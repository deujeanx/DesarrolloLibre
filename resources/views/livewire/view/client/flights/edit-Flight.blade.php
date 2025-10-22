@extends('welcome')

@section('content')
<div class="min-h-screen bg-gray-100 flex justify-center items-center p-6">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">
            Información del Vuelo 
        </h2>

        <form action="{{ route('flights.update', $flight->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Origen --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Origen</label>
                <input type="text" value="{{ $flight->origin->origin }}" 
                    disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Destino --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Destino</label>
                <input type="text" value="{{ $flight->destinie->destinie }}" 
                    disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Aerolínea --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Aerolínea</label>
                <input type="text" value="{{ $flight->airline->airline }}" 
                    disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Modelo de avión --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Modelo de avión</label>
                <input type="text" value="{{ $flight->model_plane->marca }}" 
                    disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Precio por asiento --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Precio por asiento</label>
                <input type="text" value="${{ number_format($flight->positionValue, 0, ',', '.') }}" 
                    disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Fecha --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Fecha y hora</label>
                <input type="text" value="{{ \Carbon\Carbon::parse($flight->dateHour)->format('d/m/Y H:i') }}" 
                    disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Cupos disponibles --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Cupos disponibles</label>
                <input type="text" value="{{ $flight->cantCupos }}" 
                    disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Seleccionar pasajeros --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-1">Cantidad de pasajeros</label>
                <select name="userPassenger" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                    <option value="" selected disabled>Selecciona una cantidad</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            {{-- Botón --}}
            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Confirmar Compra
            </button>
        </form>
    </div>
</div>
@endsection
