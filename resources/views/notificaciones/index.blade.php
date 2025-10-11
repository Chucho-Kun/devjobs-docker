<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notificaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl font-bold text-center mb-10">
                        Mis Notificaciones
                    </h1>

                    @forelse ($notificaciones as $notificacion )
                        <div class="p-5 gorder-gray-200 md:flex md:justify-between md:items-center">
                            
                            <div>
                                <p>Nuevo candidato para:
                                    <span class="font-bold">{{ $notificacion->data['nombre_vacante'] }}</span>
                                </p>
                                <p>
                                    <span class="font-bold">{{ $notificacion->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                            <div class="mt-5">
                                <a 
                                    class="bg-indigo-500 p-3 text-sm uppercase font-bold text-white rounded-lg hover:bg-indigo-800" 
                                    href="{{ route('candidatos.index' , $notificacion->data['id_vacante']) }}"
                                >Ver candidatos</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-600" >No hay notificaciones nuevas</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
