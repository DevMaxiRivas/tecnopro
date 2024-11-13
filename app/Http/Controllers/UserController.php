<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DateTime;

use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $cliente = User::with('roles')->role(['cliente'])->where('id', $user_id)->first();
        return view('panel.admin.cliente.index', compact('cliente'));  
        /* $user_id = Auth::id();
        $clientes = User::with('roles')->role(['cliente'])->where('id', $user_id)->get();
        return view('panel.cliente.lista_usuarios.index', compact('clientes')); */ 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editar()
    {
        
        $user_id = Auth::id();
        $cliente = User::with('roles')->where('id', $user_id)->first();
        $user_role = $cliente->getRoleNames();
        $all_roles = Role::all()->pluck('name'); //guardo todos los roles existentes
        //var_dump($all_roles_in_database);die();
        return view('panel.admin.cliente.edit', compact('cliente','user_role','all_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function actualizar(Request $request, $user_id)
    {

        /* dd($request); */

        $user = User::with('roles')->where('id', $user_id)->first();
        $user->name = $request->get('name');
        $user->dni = $request->get('dni'); 
        $user->telefono = $request->get('telefono');
        $user->domicilio = $request->get('domicilio');
        $user->email = $request->get('email');
        $nuevaPassword = $request->get('password'); //no se asigna directamente al obj $user
        // Verifica si se rellenó el campo de contraseña para encriptarla

        if (!empty($nuevaPassword)) {
            $user->password = Hash::make($nuevaPassword);    
        }

        if (!empty($request->get('password_confirmation')) && empty($request->get('current_password'))) {
            return redirect()
            ->route('cliente.editar')
            ->with('error', 'Debe completar con la contraseña anterior!');
            }
        if (!empty($request->get('current_password')) && empty($nuevaPassword)) {
                return redirect()
                ->route('cliente.editar')
                ->with('error', 'Debe completar con las nuevas contraseñas!');
        }
        if (!empty($nuevaPassword) && !empty($request->get('current_password'))){ //si escribio una contraseña anterior, verifica que sea correcta, si no lo es, no va a actualizar nada
            if (!Hash::check($request->get('current_password'), Auth::user()->password)) {
            return redirect()
            ->route('cliente.editar')
            ->with('error', 'Contraseña actual incorrecta!');
            }
        } else if(!empty($nuevaPassword) && empty($request->get('current_password'))){//si escribe una nueva contraseña, debe escribir si o si la actual
            return redirect()
            ->route('cliente.editar')
            ->with('error', 'Debe ingresar la contraseña actual!');
        }
        // Actualiza la info del user en la BD
        $user->update();
        
        return redirect()
            ->route('cliente.editar')
            ->with('alert', 'Usuario "' .$user->name. " " .$user->apellido. '" actualizado exitosamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    

    public function graficoClientes()
    {
    // Si se hace una petición AJAX
    if (request()->ajax()) {
        $labels = [];
        $counts = [];

        // Establecer la localización en español
        setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain', 'es_ES', 'es');

        // Cantidad de clientes por mes, agrupados por rol 'cliente'
        $clientes = User::where('rol', 'cliente')
                       ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                       ->groupBy('month') 
                       ->get();

        foreach ($clientes as $cliente) {
            $monthNumber = $cliente->month;
            $monthName = strftime('%B', mktime(0, 0, 0, $monthNumber, 1));  // Nombre del mes en español
            $labels[] = ucfirst($monthName);  // Capitalizar la primera letra
            $counts[] = $cliente->total;
        }

        $response = [
            'success' => true,
            'data' => [$labels, $counts],
        ];
        return json_encode($response);
    }
    return view('home');
}



    public function graficoMejoresClientes()
{
    if (request()->ajax()) {
        $labels = [];
        $counts = [];
        
        // Seleccionar los clientes con mayor gasto total en compras
        $mejoresClientes = User::join('ventas', 'users.id', '=', 'ventas.id_cliente')
            ->where('users.rol', 'cliente')
            ->select('users.name', DB::raw('SUM(ventas.total) as total_gasto'))  // Sumar el total de compras
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_gasto')  // Ordenar por gasto total de mayor a menor
            ->take(5)  // Limitar a los 5 mejores clientes
            ->get();

        foreach ($mejoresClientes as $cliente) {
            $labels[] = $cliente->name;
            $counts[] = $cliente->total_gasto;
        }

        $response = [
            'success' => true,
            'data' => [$labels, $counts],
        ];
        return json_encode($response);
    }
    return view('home');
}

   

}
