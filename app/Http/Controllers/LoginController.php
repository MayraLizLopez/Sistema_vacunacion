<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;
use App\Models\Usuario;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('security.login');
    }
    //
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $userInfo = Usuario::where('email', '=', $request->email)->first();
        if(!$userInfo){
            return back()->with('fail', 'Correo incorrecto');
        }else{
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUserNivel', $userInfo->rol);
                $request->session()->put('LoggedUser', $userInfo->id_user);
                return redirect('admin/panel/index');
            }else{
                return back()->with('fail', 'Contraseña incorrecta');
            }
        }
    }

    public function logout()
    {
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUserNivel'); 
           session()->pull('LoggedUser'); 
           return redirect('security/login');
        }
        
    }

    public function dashboard(){
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 

        $rol = session('LoggedUserNivel');
        if($rol == 'Administrador General'){
            $voluntarios = DB::table('voluntarios')->count(); 
            $instituciones = DB::table('instituciones')->where('activo', '=', true)->count();   
            $jornadas = DB::table('jornadas')->where('activo', '=', true)->count();   

            return view('admin.index', compact('voluntarios', 'instituciones', 'jornadas'), $data);

        }else{
            $id_user = session('LoggedUser');
            $id = DB::table('usuarios')->where('id_user', '=', $id_user)->value('id_insti'); 
            $voluntarios = DB::table('voluntarios')->where('id_insti', '=', $id)->count(); 
            $jornadas = DB::table('jornadas')->where('activo', '=', true)->count();   

            return view('admin.index', compact('voluntarios', 'jornadas'), $data); 
        }
    
    }
}
