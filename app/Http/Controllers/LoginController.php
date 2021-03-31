<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;

class LoginController extends Controller
{
    public function login(){
        return view('security.login');
    }
    //
    public function authenticate(Request $request)
    {
        dd($request);
        $credentials = $request->only('email', 'password');

        $usuarios = DB::select('SELECT * FROM usuarios');
       foreach ($usuarios as $usuario) {

        //dd($usuario);
         $nombre = $usuario->email;
         $nombreC = $usuario->nombre ." ". $usuario->ape_pat." ". $usuario->ape_mat;
         if($nombre == $request->email && $usuario->password == $request->password){
           session(['sesionUsu' => $nombreC]);
           //Cambiar por la vista de logín exitoso
           return view('admin.layout');
         }
       }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Correo y/o contraseña incorrectas.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
