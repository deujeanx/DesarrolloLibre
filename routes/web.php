<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserPassengerController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('FlightsList', [FlightController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('flightsList');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // =======================
    // RUTAS PARA LOS USUARIOS
    // =======================

    // <<<<<<<<<<>>>>>>>>>>>>>>
    // Rutas de la tabla Flight
    // <<<<<<<<<<>>>>>>>>>>>>>>

    // Ruta para poder traer los datos al welcome
    Route::get('flights/indexWelcome', [FlightController::class, 'indexWelcome'])
        ->name('flights.indexWelcome');

    Route::resource('flights', FlightController::class);

    Route::get('flightCreate', [FlightController::class, 'create'])->name('flight.create');
    Route::post('flightStore', [FlightController::class, 'store'])->name('flight.store');

    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>
    // Rutas de la tabla user_passengers
    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>
    Route::get('user_passengers/create/{flight_id}', [UserPassengerController::class, 'create'])
        ->name('user_passengers.create.withFlight');

    Route::resource('user_passengers', UserPassengerController::class);

    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>>>
    // Rutas para la asignacion de puestos
    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>>>


    Route::get('/positions/select/{flight_id}', [PositionController::class, 'selectPayer'])->name('positions.selectPayer');
    Route::put('/positions/select/{flight_id}', [PositionController::class, 'storePayer'])->name('positions.storePayer');

    Route::get('/positions/select-passengers/{flight_id}', [PositionController::class, 'selectPassengers'])->name('positions.selectPassengers');
    Route::put('/positions/store-passengers/{flight_id}', [PositionController::class, 'storePassengers'])->name('positions.storePassengers');

});
