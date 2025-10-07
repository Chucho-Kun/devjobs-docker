<?php

namespace App\Livewire;

use App\Models\Vacante;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MostrarVacantes extends Component
{
    public function render()
    {

        $vacantes = Vacante::where('user_id' , Auth::user()->id)->paginate(5);

        return view('livewire.mostrar-vacantes' , [
            'vacantes' => $vacantes
        ]);
    }
}
