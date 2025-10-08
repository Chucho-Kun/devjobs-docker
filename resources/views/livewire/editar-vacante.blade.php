<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')"
            autocomplete="titulo" placeholder="Titulo Vacante" />
        <x-input-error :messages="$errors->get('titulo')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />
        
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select wire:model="salario" id="salario"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        >
        <option>-- Seleccione --</option>
        @foreach ( $salarios as $salario )
            <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select wire:model="categoria" id="categoria"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
        <option>-- Seleccione --</option>
        @foreach ( $categorias as $categoria )
            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" autocomplete="empresa" placeholder="Nombre de la empresa" />
    </div>
    <x-input-error :messages="$errors->get('empresa')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />
    
    <div>
        <x-input-label for="ultimo_dia" :value="__('Fecha Límite de Postulación')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" autocomplete="ultimo_dia" />
    </div>
    <x-input-error :messages="$errors->get('ultimo_dia')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />

    <div>
        <x-input-label for="descripcion" :value="__('Descripción del Puesto')" />
        <textarea 
            wire:model="descripcion" 
            placeholder="Descripción general del puesto" 
            id="" 
            cols="30" 
            rows="3"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        >

        </textarea>
    </div>
    <x-input-error :messages="$errors->get('descripcion')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />

    <div>
        <x-input-label for="imagen_nueva" :value="__('Nueva Imagen')" />
        <x-text-input id="imagen_nueva" class="block mt-1 w-full" type="file" wire:model="imagen_nueva" accept="image/*" />
    </div>

    <div class="my-5 w-80">
        @if ($imagen_nueva)
            NUEVA IMAGEN:
            <img src="{{ $imagen_nueva->temporaryUrl() }}" alt="preview de imagen">
        @endif
    </div>
    {{-- <x-input-error :messages="$errors->get('imagen_nueva')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" /> --}}

    <div class="my-5 w-80">
        <x-input-label for="imagen" :value="__('Imagen Actual')" />
        <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen Vacante de ' . $titulo }}">
        <x-input-error :messages="$errors->get('imagen_nueva')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />
    </div>


    <x-primary-button>Guardar Cambios</x-primary-button>

</form>