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
