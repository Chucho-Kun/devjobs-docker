<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Salario;
use Livewire\Component;

class CrearVacante extends Component
{
    public function render()
    {
        // Consultar DB desde el Modelo Salario
        $salarios = Salario::all();

        // Consultar DB desde el Modelo de Categoria
        $categorias = Categorias::all();

        return view('livewire.crear-vacante' , [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
