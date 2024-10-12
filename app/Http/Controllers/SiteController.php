<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function users(){
        //Se va a modificar cuando se maneje lo del login con secciones
        $userRole = 1;

        if($userRole == 1){
            $user = User::all();
        } else {
            $user = User::where('id_rol', 2)->get();
        }
        return view('ciisti.users', compact('user'));
    }
    public function form($id = null) {
        $action = $id ? 'update' : 'add';
        $user = null;
        if ($id) {
            $user = User::find($id);
        }
        return view('ciisti.forms', compact('action', 'user'));
    }

}
