@extends('welcome')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10 px-4">
    <div class="w-full max-w-lg bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 text-center">Formulario de Pago</h2>

        <form action="{{ route('pays.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="flight_id" value="{{ $flight->id }}">

            {{-- Método de pago --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Método de Pago</label>
                <flux:select name="metodoPago" class="w-full border-gray-300 rounded-md p-2" required>
                    <flux:select.option value="">Seleccione un método</flux:select.option>
                    <flux:select.option value="tarjeta credito">Tarjeta de Crédito</flux:select.option>
                    <flux:select.option value="tarjeta debito">Tarjeta de Débito</flux:select.option>
                    <flux:select.option value="paypal">PayPal</flux:select.option>
                </flux:select>
            </div>

            {{-- Titular de la tarjeta --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Nombre del titular</label>
                <flux:input type="text" class="w-full border-gray-300 rounded-md p-2" placeholder="Juan Pérez" required/>
            </div>

            {{-- Número de tarjeta --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Número de tarjeta</label>
                <flux:input type="text" class="w-full border-gray-300 rounded-md p-2" placeholder="1234 5678 9012 3456" maxlength="19" required/>
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- Fecha de expiración --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Fecha de expiración</label>
                    <flux:input type="month" class="w-full border-gray-300 rounded-md p-2" required/>
                </div>

                {{-- CVV --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-2">CVV</label>
                    <flux:input type="text" class="w-full border-gray-300 rounded-md p-2" maxlength="4" placeholder="123" required/>
                </div>
            </div>

            {{-- Checkbox de términos --}}
            <div class="flex items-center">
                <input type="checkbox" class="mr-2" required>
                <label class="text-gray-700 text-sm">
                    Acepto los <a href="#" class="text-blue-600 underline">Términos y Condiciones</a> y el
                    <a href="#" class="text-blue-600 underline">tratamiento de datos personales</a>.
                </label>
            </div>

            {{-- Botón de envío --}}
            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg transition">
                Pagar ahora
            </button>
        </form>
    </div>
</div>
@endsection
