<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>

    @if (session()->has('mensaje'))
        <p class="uppercase border border-green-600 text-green-600 font-bold p-2 my-5 rounded text-sm">
            {{ session('mensaje') }}
        </p>
    @else
        <form 
            wire:submit.prevent='postularme'
            action=""
            class="w-96 mt-5"
        >
            <div class="mb-4">
                <x-input-label for="cv" :value="__('Curriculum | Hoja de Vida (PDF)')" />
                <x-text-input id="cv" name="cv" type="file" accept=".pdf" wire:model="cv" class="block mt-1 w-full" />
            </div>

            @error('cv')
                <x-input-error :messages="$errors->get('cv')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs mb-3" />
            @enderror

            <x-primary-button>
                Postularme
            </x-primary-button>


        </form>
    @endif

</div>