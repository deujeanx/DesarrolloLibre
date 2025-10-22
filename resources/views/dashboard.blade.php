<x-layouts.app :title="__('Dashboard')">
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
