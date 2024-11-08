<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5', 'max:255', 'regex:/^[\p{L} ]+$/u'],
            'dni' => ['required', 'integer', 'min:7'],
            'email' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'telefono' => ['required', 'integer'],
            'domicilio' => ['required', 'string'],
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'string', 'min:8'];
            $rules['rol'] = ['required'];
        } else if($this->isMethod('put')) {
            $userId = $this->route('usuario');

            $rules['email'] = [
                'required',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                Rule::unique('users')->ignore($userId), // Esto evita que se produzca un error de unicidad si el admin no cambia el email del usuario existente.
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.min' => 'El campo nombre debe tener un minimo de 5 caracteres',
            'name.regex' => 'El campo nombre debe tener solo letras',

            'dni.required' => 'El campo dni es obligatorio.',
            'dni.integer' => 'El campo dni debe ser un numero',
            'dni.min' => 'El campo dni debe tener como minimo 7 caracteres',

            'rol.required' => 'El campo rol es obligatorio',
            
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener 8 caracteres como minimo',
            'password.confirmed' => 'El campo contraseña no coincide con la confirmacion',

            'email.required' => 'El campo email es obligatorio.',
            'email.regex' => 'El campo email tiene un formato incorrecto',
            'email.unique' => 'Este email ya se encuentra registrado',

            'telefono.required' => 'El campo telefono es obligatorio',
            'telefono.integer' => 'El campo telefono debe ser numerico',

            'domicilio.required' => 'El campo domicilio es obligatorio',
        ];
    }
}
