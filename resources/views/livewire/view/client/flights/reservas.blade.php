{{-- resources/views/catalogoFlights.blade.php --}}
@extends('welcome')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">Mira tus reservaciones de vuelo</h1>
            <section class="shadow-3xl flex grid grid-cols-3">
                @forelse ($reservas as $reserva)
                    <a href="{{route('reserva.show', $reserva->id)}}">
                        <div class="shadow-lg hover:bg-gray-200 bg-white rounded p-2 text-cente">
                            <div class="w-full">
                                Vuelo #{{$reserva->id}}
                            </div>
                            <hr>
                            <div class="flex m-2 p-2 rounded bg-gray-100 gap-4">
                                <div>
                                    Origen: {{$reserva->flight->origin->origin}}
                                </div>
                                <div>
                                    Destino: {{$reserva->flight->destinie->destinie}}
                                </div>
                            </div>
                            <div class="m-2 border rounded-3xl p-2">
                                Fecha: {{$reserva->flight->dateHour}}
                            </div>
                        </div>
                    </a>

                @empty
                    Aun no tienes resercvaciones
                @endforelse
            </section>
        </div>
    </div>

@endsection
