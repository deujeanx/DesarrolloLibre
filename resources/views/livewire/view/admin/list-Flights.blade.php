<x-layouts.app>
<div class="relative mb-6 w-full">
    <flux:heading size="xl" level="1">{{ __('Listado de Voletos') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Aqui podras tener el listado de los voletos con permisos administrador') }}</flux:subheading>
    <flux:separator variant="subtle" />
</div>

 <table>
        <tr>

        </tr>
    </table>
   @forelse ($vuelos as $vuelo)

   @empty
       <p>
        No hay vuelos disponibles en este momento
       </p>
   @endforelse
</x-layouts.app>
