<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::latest()->get();
        return view('panel.admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $usuario = new User();

        $roles = Role::all()->pluck('name');

        return view('panel.admin.usuarios.create', compact('usuario', 'roles'));
    }

    public function store(UserRequest $request) 
    {
        $usuario = new User();

        $usuario->rol = $request->rol;
        $usuario->name = $request->name;
        $usuario->dni = $request->dni;
        $usuario->telefono = $request->telefono;
        $usuario->domicilio = $request->domicilio;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->assignRole($request->rol);

        $usuario->save();

        // Falta enviar email al usuario
        
        return redirect()
            ->route('usuarios.index')
            ->with('alert', 'Usuario "' . $usuario->name . '" creado exitosamente.');
    }

    public function show(User $user)
    {

    }

    public function edit(User $usuario)
    {
        $roles = Role::all()->pluck('name');

        return view('panel.admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(UserRequest $request, User $usuario) 
    {
        $usuario->update([
            'name' => $request->name,
            'dni' => $request->dni,
            'telefono' => $request->telefono,
            'domicilio' => $request->domicilio,
            'email' => $request->email,
            'activo' => $request->activo
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('alert', 'Usuario "' . $usuario->name . '" actualizado exitosamente.');
    }

    public function destroy(User $user) 
    {

    }
}
