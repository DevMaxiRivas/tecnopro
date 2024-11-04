<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

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

    public function store(Request $request) 
    {

    }

    public function show(User $user)
    {

    }

    public function edit(User $usuario)
    {
        $roles = Role::all()->pluck('name');

        return view('panel.admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $user) 
    {

    }

    public function destroy(User $user) 
    {

    }
}
