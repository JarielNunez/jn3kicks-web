<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'    => 'required|string|max:255',
            'precio'    => 'required|numeric|min:0',
            'imagen'    => 'required|string|max:255',
            'categoria' => 'required|in:running,basketball,casual',
            'marca'     => 'required|in:nike,converse',
            'genero'    => 'required|in:hombre,mujer,unisex',
            'stock'     => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'    => 'El nombre es obligatorio.',
            'nombre.max'         => 'El nombre no puede pasar de 255 caracteres.',
            'precio.required'    => 'El precio es obligatorio.',
            'precio.numeric'     => 'El precio debe ser un número.',
            'precio.min'         => 'El precio no puede ser negativo.',
            'imagen.required'    => 'La ruta de la imagen es obligatoria.',
            'imagen.max'         => 'La ruta de la imagen es demasiado larga.',
            'categoria.required' => 'Selecciona una categoría.',
            'categoria.in'       => 'La categoría debe ser running, basketball o casual.',
            'marca.required'     => 'Selecciona una marca.',
            'marca.in'           => 'La marca debe ser nike o converse.',
            'genero.required'    => 'Selecciona un género.',
            'genero.in'          => 'El género debe ser hombre, mujer o unisex.',
            'stock.required'     => 'El stock es obligatorio.',
            'stock.integer'      => 'El stock debe ser un número entero.',
            'stock.min'          => 'El stock no puede ser negativo.',
        ];
    }
}
