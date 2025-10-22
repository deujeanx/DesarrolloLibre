<x-layouts.auth>
<div class="flex flex-col gap-8">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-8">
        @csrf

        {{-- Datos personales --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Primer Nombre -->
            <flux:input
                wire:model="first_name"
                :label="__('Primer Nombre')"
                type="text"
                required
                autofocus
                autocomplete="primer nombre"
                :placeholder="__('Primer nombre')"
            />

            <!-- Segundo Nombre -->
            <flux:input
                wire:model="middle_name"
                :label="__('Segundo Nombre')"
                type="text"
                autofocus
                autocomplete="segundo nombre"
                :placeholder="__('Segundo nombre')"
            />

            <!-- Primer Apellido -->
            <flux:input
                wire:model="first_surname"
                :label="__('Primer Apellido')"
                type="text"
                required
                autocomplete="primer apellido"
                :placeholder="__('Primer apellido')"
            />

            <!-- Segundo Apellido -->
            <flux:input
                wire:model="middle_surname"
                :label="__('Segundo Apellido')"
                type="text"
                autocomplete="segundo apellido"
                :placeholder="__('Segundo apellido')"
            />
        </div>

        {{-- Información de contacto --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Correo electrónico -->
            <flux:input
                wire:model="email"
                :label="__('Correo Electrónico')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Número de celular -->
            <flux:input
                wire:model="number_phone"
                :label="__('Número de Celular')"
                type="number"
                required
                :placeholder="__('Número de celular')"
            />
        </div>

        {{-- Documento --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tipo de documento -->
            <div>
                <flux:label>Tipo de Documento</flux:label>
                <flux:select wire:model="type_document" placeholder="Seleccione...">
                    <flux:select.option value="cedula_ciudadana">Cédula Ciudadana</flux:select.option>
                    <flux:select.option value="registro_civil">Registro Civil</flux:select.option>
                    <flux:select.option value="pasaporte">Pasaporte</flux:select.option>
                    <flux:select.option value="cedula_extrangera">Cédula Extranjera</flux:select.option>
                </flux:select>
            </div>

            <!-- Número de documento -->
            <flux:input
                wire:model="number_document"
                :label="__('Número de Documento')"
                type="number"
                required
                :placeholder="__('Número de documento')"
            />
        </div>

        {{-- Contraseña --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Contraseña -->
            <flux:input
                wire:model="password"
                :label="__('Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Contraseña')"
                viewable
            />

            <!-- Confirmar contraseña -->
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirmar Contraseña')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirmar contraseña')"
                viewable
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full md:w-auto">
                {{ __('Crear cuenta') }}
            </flux:button>
        </div>
    </form>

    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400 space-x-1 rtl:space-x-reverse">
        <span>{{ __('¿Ya tienes una cuenta?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Iniciar sesión') }}</flux:link>
    </div>
</div>

</x-layouts.auth>