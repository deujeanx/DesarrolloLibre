@extends('welcome')

@section('title', 'Inicio')

@section('content')
    {{-- HERO DE BÚSQUEDA --}}
    <section class="relative bg-gradient-to-b from-blue-100 via-blue-50 to-white py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-4xl font-bold text-blue-700 text-center mb-10">
                Encuentra tu próximo destino con AirHub
            </h1>

            {{-- Caja de búsqueda --}}
            <div class="bg-white shadow-xl rounded-2xl p-6 flex flex-col md:flex-row md:items-end gap-6">
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-600">
                        <input type="radio" name="tipo_vuelo" checked class="text-blue-600 focus:ring-blue-500">
                        Ida y vuelta
                    </label>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-600">
                        <input type="radio" name="tipo_vuelo" class="text-blue-600 focus:ring-blue-500">
                        Solo ida
                    </label>
                </div>

                <div class="flex flex-col md:flex-row w-full gap-4">
                    <div class="flex-1">
                        <label class="text-sm text-gray-500">Origen</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>Bogotá (BOG)</option>
                            <option>Medellín (MDE)</option>
                            <option>Pereira (PEI)</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="text-sm text-gray-500">Destino</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>Cartagena (CTG)</option>
                            <option>Barranquilla (BAQ)</option>
                            <option>Cali (CLO)</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Ida</label>
                        <input type="date"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Vuelta</label>
                        <input type="date"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="text-sm text-gray-500">Pasajeros</label>
                        <select class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg transition self-end">
                        Buscar
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- SECCIÓN DE CATÁLOGO DE VUELOS --}}
    <section class="max-w-6xl mx-auto mt-16 px-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Vuelos disponibles</h2>

        @include('livewire.view.client.flights.catalog') {{-- Aquí insertas el catálogo bonito --}}
    </section>
@endsection
