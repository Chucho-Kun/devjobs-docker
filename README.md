<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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
