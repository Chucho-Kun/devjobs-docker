<form action="" class="md:w-1/2 space-y-5">
    @csrf
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" :value="old('titulo')"
            autocomplete="titulo" placeholder="Titulo Vacante" />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select name="salario" id="salario"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        >
        <option>-- Seleccione --</option>
        @foreach ( $salarios as $salario )
            <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
        @endforeach
        </select>
    </div>

    <div>
        <x-input-label for="salario" :value="__('Categoria')" />
        <select name="categoria" id="categoria"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
        <option>-- Seleccione --</option>
        @foreach ( $categorias as $categoria )
            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
        @endforeach
        </select>
    </div>
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" name="empresa" :value="old('empresa')" autocomplete="empresa" placeholder="Nombre de la empresa" />
    </div>
    <div>
        <x-input-label for="ultimo_dia" :value="__('Fecha Límite de Postulación')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" name="ultimo_dia" :value="old('ultimo_dia')" autocomplete="ultimo_dia" />
    </div>
    
    <div>
        <x-input-label for="ultimo_dia" :value="__('Descripción del Puesto')" />
        <textarea 
            name="descripcion" 
            placeholder="Descripción general del puesto" 
            id="" 
            cols="30" 
            rows="3"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        >

        </textarea>
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" name="imagen" />
    </div>

    <x-primary-button>Crear Vacante</x-primary-button>

</form>