## 🚀 Tech Stack

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E5D94?style=for-the-badge&logo=laravel&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)

## Mailpit Local URL
```
http://127.0.0.1:8025
```
## Correct URL to storage images
### A- app/livewire/CrearVacante.php
```
public function crearVacante()
    {
        $datos = $this->validate();    

        // Almacenar la Imagen
        $imagen = $this->imagen->store('vacantes','public');
        $nombre_imagen = str_replace('vacantes/' , '' , $imagen);
        
        // Crear la vacante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombre_imagen,
            'user_id' => Auth::user()->id
        ]);
        // Crear un mensaje
        session()->flash('mensaje','La vacante se publicó correctamente');

        // Redireccionar 
        return redirect()->to('dashboard');
    }
```
### B- resources/views/livewire/editar-vacante.blade.php
```
 <div class="my-5 w-80">
        <x-input-label for="imagen" :value="__('Imagen Actual')" />
        <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen Vacante de ' . $titulo }}">
        <x-input-error :messages="$errors->get('imagen_nueva')" class="border border-red-700 bg-red-100 text-red-600 font-bold uppercase p-2 mt-2 text-xs" />
    </div>
```

## Code for Laravel 12 + Livewire 3.6 - Delete images and vacancies at the same time
### resources/views/livewire/mostrar-vacantes.blade.php
```
<button 
    onclick="confirmarEliminacion({{ $vacante->id }})"
    class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Eliminar
</button>
```
```
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
```
### app/Livewire/MostrarVacantes.php
```
<?php

namespace App\Livewire;

use App\Models\Vacante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarVacantes extends Component
{
   #[On('eliminarVacante')]
    public function eliminarVacante($vacanteId)
    {
        $vacante = Vacante::findOrFail($vacanteId);
        $vacante->delete();
        Storage::disk('public')->delete('vacantes/' . $vacante->imagen);
        $this->dispatch('vacanteEliminada', id: $vacanteId);
    }

    public function render()
    {

        $vacantes = Vacante::where('user_id' , Auth::user()->id)->paginate(5);

        return view('livewire.mostrar-vacantes' , [
            'vacantes' => $vacantes
        ]);
    }
}
```
