<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // Estado de usuario
    const INACTIVO = 0;
    const ACTIVO = 1;

    // Roles del Usuario
    const CLIENTE = 'cliente';
    const EMPLEADO_COMPRAS = 'empleado_compras';
    const EMPLEADO_VENTAS = 'empleado_ventas';
    const ADMINISTRADOR = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rol',
        'name',
        'dni',
        'telefono',
        'email',
        'password',
        'domicilio',
        'activo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Compras del cliente en el sistema
    public function compras_cliente() {
        $this->hasMany(Venta::class, 'id_cliente');
    }

    // Ventas a Clientes del Empleado
    public function ventas_empleado() {
        $this->hasMany(Venta::class, 'id_empleado');
    }

    // Compras a Proveedores del Empleado
    public function compras_empleado_proveedor() {
        $this->hasMany(Compra::class, 'id_empleado');
    }
}
