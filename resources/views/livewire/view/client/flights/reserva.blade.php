{{-- resources/views/catalogoFlights.blade.php --}}
@extends('welcome')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">Vuelo #{{$reserva->id}}</h1>
            <section class="shadow-2xl bg-white p-3 flex grid grid-cols-3">
                <div class="flex">
                    <div>
                        origen: {{$reserva->flight->origin->origin}}
                    </div>
                    <div>
                        destino: {{$reserva->flight->destinie->destinie}}
                    </div>
                    <div>
                        fecha: {{$reserva->flight->dateHour}}
                    </div>
                </div>
                <div class="flex">
                    <div>
                        modelo de avion: {{$reserva->flight->model_plane->marca}}
                    </div>
                    <div>
                        capacidad: {{$reserva->flight->model_plane->capacidad}}
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
