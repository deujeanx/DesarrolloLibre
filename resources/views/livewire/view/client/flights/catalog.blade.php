{{-- resources/views/catalogoFlights.blade.php --}}
@extends('welcome')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">Catálogo de Vuelos</h1>

            {{-- Filtros --}}
            <div
                class="bg-white shadow-md rounded-xl p-6 mb-8 flex flex-col md:flex-row gap-4 md:items-center md:justify-between">
                <div class="flex flex-col md:flex-row gap-4 w-full">
                    <select id="originFilter" class=" w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" id="filterOrigin">

                        <option disabled selected>Lugar de origen</option>

                        @foreach ($origenes as $origen)
                            
                            <option value="{{$origen->origin}}">{{$origen->origin}}</option>
                            
                        @endforeach
                    </select>
                    <select id="destinyFilter" class=" w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" id="filterOrigin">

                        <option disabled selected>Lugar de destino</option>

                        @foreach ($destinos as $destini)
                            
                            <option value="{{$destini->destinie}}">{{$destini->destinie}}</option>
                            
                        @endforeach
                    </select>
                    <input type="date" id="filterDate"
                        class="w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>

                <button id="clearFilters"
                    class="mt-3 md:mt-0 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Limpiar filtros
                </button>
            </div>

            {{-- Catálogo --}}
            <div id="flightsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($flights as $flight)
                    @php
                        $dateOnly = \Carbon\Carbon::parse($flight->dateHour)->format('Y-m-d');
                    @endphp
                    <div class="flightCard bg-white rounded-2xl shadow-md hover:shadow-lg transition duration-200 overflow-hidden"
                        data-origin="{{ strtolower($flight->origin->origin) }}"
                        data-destiny="{{ strtolower($flight->destinie->destinie) }}" 
                        data-date="{{ $dateOnly }}">
                        <div class="p-5">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                {{ $flight->origin->origin }} → {{ $flight->destinie->destinie }}
                            </h2>
                            <p class="text-gray-600 text-sm mb-1">
                                <strong>Aerolínea:</strong> {{ $flight->airline->airline }}
                            </p>
                            <p class="text-gray-600 text-sm mb-1">
                                <strong>Modelo avión:</strong> {{ $flight->model_plane->marca }}
                                ({{ $flight->model_plane->capacidad }} asientos)
                            </p>
                            <p class="text-gray-600 text-sm mb-1">
                                <strong>Precio por asiento:</strong>
                                ${{ number_format($flight->positionValue, 0, ',', '.') }}
                            </p>
                            <p class="text-gray-600 text-sm mb-4">
                                <strong>Fecha y hora:</strong> {{ $flight->dateHour }}
                            </p>

                            <a href="{{ route('flights.edit', $flight->id) }}"
                                class="block text-center bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
                                Comprar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($flights->isEmpty())
                <div class="text-center text-gray-600 mt-8">
                    No hay vuelos disponibles en este momento.
                </div>
            @endif
        </div>
    </div>

@endsection
