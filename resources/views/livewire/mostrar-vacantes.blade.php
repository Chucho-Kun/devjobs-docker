<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

    @forelse ( $vacantes as $vacante )

    <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
        <div class="space-y-3">
            <a href="{{ route( 'vacantes.show' , $vacante->id ) }}" class="text-xl font-bold">
                {{ $vacante->titulo }}
            </a>
            <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
            <p class="text-sm text-gray-500 font-bold">Último Día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
        </div>

        <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
            <a href=""
                class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Candidatos
            </a>
            <a href="{{ route('vacantes.edit' , $vacante->id) }}"
                class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar
            </a>
            <button 
                onclick="confirmarEliminacion({{ $vacante->id }})"
                class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
            >
                Eliminar
            </button>

            

        </div>
    </div>

    @empty

    <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>

    @endforelse

    <div class="m-5">
        {{ $vacantes->links() }}
    </div>

</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmarEliminacion(vacanteId) {
            Swal.fire({
                title: '¿Eliminar Vacante?',
                text: 'La vacante se eliminará permanentemente',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarVacante', { vacanteId });
                }
            });
        }
    
        window.addEventListener('vacanteEliminada', event => {
            Swal.fire({
                title: 'Vacante Eliminada',
                text: `La vacante fue eliminada correctamente`,
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endpush