<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Obtener usuario autenticado
        $roleName = $user->rol->rol; // Obtener nombre del rol

        //Se va a modificar cuando se maneje lo del login con secciones

        if($roleName == "Administrador"){
            $user = User::all();
        } else if($roleName == "Staff") {
            $user = User::where('id_rol', 3)->get();
        } else{
            return redirect()->route('users')->with('error', 'No tienes permisos para ver esta información.');
        }
        return view('ciisti.users', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action = "create";
        $user = null;
        return view('ciisti.forms', compact('action', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    if ($request->isMethod('post')) {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|regex:/^(\d+\s*)+$/',
            'rol' => 'required|not_in:0',
        ], [
            'name.required' => 'Campo nombre es obligatorio.',
            'last_name.required' => 'Campo apellidos es obligatorio.',
            'email.required' => 'Campo correo es obligatorio.',
            'email.email' => 'Campo correo no tiene el formato correcto.',
            'password.required' => 'Campo contraseña es obligatorio.',
            'phone.required' => 'Campo teléfono es obligatorio.',
            'phone.regex' => 'Campo teléfono no tiene el formato correcto.',
            'rol.not_in' => 'Campo rol es obligatorio.',
        ]);
        // Crear el usuario en la base de datos
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->phone = $request->input('phone');
        $user->id_rol = $request->input('rol');
        $user->save();

        return response()->json(['message' => 'Usuario registrado.'], 200);
    }
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
    public function edit(int $id)
    {
        $action = "update";
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado.');
        }
        return view('ciisti.forms', compact('action', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|regex:/^(\d+\s*)+$/',
            'rol' => 'required|not_in:0',
        ], [
            'name.required' => 'Campo nombre es obligatorio.',
            'last_name.required' => 'Campo apellidos es obligatorio.',
            'email.required' => 'Campo correo es obligatorio.',
            'email.email' => 'Campo correo no tiene el formato correcto.',
            'password.required' => 'Campo contraseña es obligatorio.',
            'phone.required' => 'Campo teléfono es obligatorio.',
            'phone.digits_between' => 'Campo teléfono no tiene el formato correcto.',
            'rol.not_in' => 'Campo rol es obligatorio.',
        ]);
        // Crear el usuario en la base de datos
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->phone = $request->input('phone');
        $user->id_rol = $request->input('rol');
        $user->save();

        return response()->json(['message' => 'Datos actualizados.'], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'Usuario eliminado.']);
    }
}
