<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se va a modificar cuando se maneje lo del login con secciones
        $userRole = 1;
        if($userRole == 1){
            $user = User::all();
        } else {
            $user = User::where('id_rol', 2)->get();
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
            'phone' => 'required|regex:/^[0-9]+$/',
            'rol' => 'required',
        ], [
            'name.required' => 'Campo nombre es obligatorio.',
            'last_name.required' => 'Campo apellidos es obligatorio.',
            'email.required' => 'Campo correo es obligatorio.',
            'email.email' => 'Campo correo no tiene el formato correcto.',
            'password.required' => 'Campo contraseña es obligatorio.',
            'phone.required' => 'Campo teléfono es obligatorio.',
            'phone.digits_between' => 'Campo teléfono no tiene el formato correcto.',
            'rol.required' => 'Campo Rol es obligatorio.',
        ]);
        dd('Entro');
        // Crear el usuario en la base de datos
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->phone = $request->input('phone');
        $user->id_rol = $request->input('rol');
        dd($user);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
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
    public function update(Request $request, string $id)
    {
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
