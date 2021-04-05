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
           session()->pull('LoggedUser'); 
           return redirect('security/login');
        }
        
    }

    public function dashboard(){
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        return view('admin.index', $data);     
    
    }
}
