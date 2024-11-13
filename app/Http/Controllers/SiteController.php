<?php

namespace App\Http\Controllers;

use App\Mail\ComunicationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\alert;

class SiteController extends Controller
{
    public function login()
    {
        return view('ciisti.login');
    }

    public function form()
    {
        $staff = User::where('id_rol', '=', 2)->get();
        $moderation = User::where('id_rol', '=', 3)->get();
        return view('components.form_email', compact('staff', 'moderation'));
    }

    public function email(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'selectA' => 'required',
            ], [
                'title.required' => 'Campo título es obligatorio.',
                'description.required' => 'Campo descripción es obligatorio.',
                'selectA.required' => 'Debes seleccionar al menos un destinatario.',
            ]);

            $data = $request->only(['title', 'description']);
            $selectedAddressees = json_decode($request->input('selectA'), true);
            $emails = collect();
            foreach ($selectedAddressees as $usuario) {
                if ($usuario['id'] === 'todos') {
                    $emails = $emails->merge(User::where('id_rol', '!=', 1)->pluck('email'));
                } elseif ($usuario['id'] === 'staff') {
                    $emails = $emails->merge(User::where('id_rol', '=', 2)->pluck('email'));
                } elseif ($usuario['id'] === 'moderadores') {
                    $emails = $emails->merge(User::where('id_rol', '=', 3)->pluck('email'));
                } else {
                    $user = User::find($usuario['id']);
                    if ($user) {
                        $emails->push($user->email);
                    }
                }
            }
            $emails = $emails->unique();
            Mail::to($emails->toArray())->send(new ComunicationMail($data));
            return response()->json(['message' => 'Correo enviado.'], 200);
        }
    }
}
