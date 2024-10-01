<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'domicilio' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'name.required' => 'El campo nombre es obligatorio.',

            'dni.required' => 'El campo dni es obligatorio.',

            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email tiene un formato incorrecto',
            'email.unique' => 'Este email ya se encuentra registrado',

            'domicilio.required' => 'El campo domicilio es obligatorio',
            
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener 8 caracteres como minimo',
            'password.confirmed' => 'El campo contraseña no coincide con la confirmacion',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'rol' => User::CLIENTE,
            'name' => $data['name'],
            'dni' => $data['dni'],
            'email' => $data['email'],
            'domicilio' => $data['domicilio'],
            'password' => Hash::make($data['password']),
        ])->assignRole(User::CLIENTE);
    }
}
