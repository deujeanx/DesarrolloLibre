<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($flight_id)
    {
        $flight = Flight::findOrFail($flight_id);

        return view('livewire.view.pay.metodoPay', compact('flight'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'metodoPago' => 'required|string|max:255',
            'flight_id' => 'required|integer|exists:flights,id',
        ]);

        $flight = Flight::findOrFail($validated['flight_id']);

        $cantidadPeople = $flight->userPassenger;
        $valorXpuesto = $flight->positionValue;
        $total = $cantidadPeople * $valorXpuesto;

        $validated['flight_id'] = $flight->id;
        $validated['user_payer_id'] = auth()->user()->id;
        $validated['total'] = $total;

        Pay::create($validated);

        Session::flash('alert', [
        'icon' => 'success',
        'title' => '¡Éxito!',
        'text' => 'Compra Exitosa!!.',
        ]);

        return view('welcome')
            ->with('success', 'Pago registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pay $pay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay $pay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pay $pay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pay $pay)
    {
        //
    }
}
