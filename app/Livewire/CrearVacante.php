<?php

namespace App\Livewire;

use App\Models\Categorias;
use App\Models\Salario;
use App\Models\Vacante;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024'
    ];

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
