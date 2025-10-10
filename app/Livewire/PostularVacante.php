<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{

    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();
        // Almacenar el CV
        $cv = $this->cv->store('cv','public');
        $datos['cv'] = str_replace('cv/' , '' , $cv);

        // Crear al candidato a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => Auth::user()->id,
            'cv' => $datos['cv']
        ]);
        
        // Crear notificacion y enviar el email
        $this->vacante->reclutador->notify( new NuevoCandidato( $this->vacante->id, $this->vacante->titulo, Auth::user()->id ) );
        
        // Mostrar aviso al usuario de ok
        session()->flash('mensaje' , 'Se envió correctamente tu información');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
