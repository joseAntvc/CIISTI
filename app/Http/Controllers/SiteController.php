<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function users(){
        $user = User::with('rol')->get();
        return view('ciisti.users', compact('user'));
    }
}
