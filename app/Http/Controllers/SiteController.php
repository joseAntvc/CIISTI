<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function users(){
        $userRole = 1;
        $user = User::where('id_rol', 2)->get();

        if($userRole == 1){
            $user = User::all();
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
