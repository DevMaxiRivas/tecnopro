<?php

namespace App\Http\Requests;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'imagen' => 'bail|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nombre' => 'bail|required|max:255',
            'id_categoria' => 'bail|required|integer|exists:categorias,id,activo,'.Producto::ACTIVO,
            'precio' => 'bail|required|numeric|min:0',
            'stock_disponible' => 'bail|required|integer|min:0',
            'descripcion' => 'bail|required|string|max:65535'
        ];
    
        if ($this->isMethod('put')) { // para el método update
            $productoId = $this->route('producto');

            $rules['nombre'] = [
                'required',
                'max:255',
                Rule::unique('productos')->ignore($productoId), // Esto evita que se produzca un error de unicidad si el usuario no cambia el nombre del producto existente.
            ];

            $rules['imagen'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';

        } else if($this->isMethod('post')){ // para el metodo store
            $rules['imagen'] = 'bail|required|image|mimes:jpeg,png,jpg,webp|max:2048';
        }
    
        return $rules;
    }

    public function messages()
    {
        return [
            'imagen.required' => 'Imagen requerida',
            'imagen.mimes' => 'Formato incorrecto (jpeg,png,jpg,webp).',
            'imagen.max' => 'Tamaño de la imagen excede los 2048 mb',
            'imagen.image' => 'Debe subir un archivo con formato de imagen',

            'nombre.required' => 'Nombre requerido',
            'nombre.max' => 'Formato incorrecto, no debe excederse de los 120 caracteres',

            'id_categoria.required' => 'Categoria requerida',
            'id_categoria.exists' => 'Categoria inexistente',
            'id_categoria.activo' => 'Categoria con estado inactivo',

            'precio.required' => 'Precio requerido',
            'precio.numeric' => 'Debe ingresar un numero entero o decimal',

            'stock_disponible.required' => 'Stock disponible requerido',
            'stock_disponible.min' => 'Stock disponible debe ser mayor a 0',
            'stock_disponible.integer' => 'Debe ingresar un numero entero',

            'descripcion.required' => 'Descripcion requerida',
            'descripcion.max' => 'Descripcion no debe ser mas de 65535 caracteres'
        ];
    }
}
