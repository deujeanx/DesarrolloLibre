<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $flights = Flight::with(['origin', 'destinie', 'airline', 'model_plane'])->where('estado', 'disponible')->get();        
        return view('dashboard', compact('flights'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        return view('livewire.view.client.flights.edit-Flight', compact('flight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        $request->validate([
            'userPassenger' => 'required|integer|min:1',
        ]);

        $nuevosCupos = $flight->cantCupos - $request->userPassenger;

        if ($nuevosCupos < 0) {
            return back()->with('error', 'No hay suficientes cupos disponibles para esa cantidad de pasajeros.');
        }

        $flight->cantCupos = $nuevosCupos;
        $flight->userPassenger = $request->userPassenger;
        $flight->estado = $nuevosCupos == 0 ? 'lleno' : 'disponible';
        $flight->save();

        // Redirigimos a la vista para registrar pasajeros
        return redirect()
            ->route('user_passengers.create.withFlight', ['flight_id' => $flight->id, 'cantidad' => $request->userPassenger]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        //
    }

    public function indexWelcome()
    {
        $flights = Flight::with(['origin', 'destinie', 'airline', 'model_plane'])->where('estado', 'disponible')->get();

        return view('livewire.view.client.flights.list-Flights', compact('flights'));
    }
}
