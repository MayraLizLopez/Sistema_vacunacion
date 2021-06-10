<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;
use App\Models\Usuario;
use App\Models\Sede;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

use App\Mail\RestartPassword;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

     /**
     * Método que permite la redirección a la vista de login.
     *
     */
    public function login(){
        return view('security.login');
    }
    
    /**
     * Método que permite la autentificación del login validando el correo y la contraseña en caso de ser correctos los datos, redireccionara a inicio , en caso contrario enviara mensajes de error
     */
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

    /**
     * Método que permite el cierre de sesión
     */
    public function logout()
    {
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUserNivel'); 
           session()->pull('LoggedUser'); 
           return redirect('security/login');
        }
        
    }

    /**
     * Método para la vista de recuperar contraseña
     */
    public function password(){
        return view('security.password');
    }

    /**
     * Método para la vista de recuperar contraseña envia correo al usuario
     */
    public function restartPassword($email, $pass){
        $usuario1 = DB::table('usuarios')->where('email', '=', $email)->first(); 
        if($usuario1 == null){
            return response()->json([
                'isOk' => false,
                'message' => 'Correo incorrecto, ingrese un correo valido'
            ]);    
        }
        $usuario = Usuario::findOrFail($usuario1->id_user);
        $data = [
            'nombre' => $usuario->nombre . ' ' . $usuario->ape_pat . ' ' . $usuario->ape_mat,
            'pass' => $pass,
        ];
        Mail::to($usuario->email)->send(new RestartPassword($data));
        $usuario->password = Hash::make($pass);
        $save = $usuario->save();
        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡Contraseña restaurada, te enviamos un correo con tu nueva contraseña!'
            ]);     
        }else{
            return response()->json([
                'isOk' => false,
                'message' => '¡No fue posible restaurar la contraseña!'
            ]);     
        }
    }

    /**
     * Método que redirecciona al inicio y se realizan consultas para el despliegue de información tomando en cuenta el rol del usuario
     */
    public function dashboard(){
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $rol = session('LoggedUserNivel');
        if($rol == 'Administrador General'){
            $voluntarios = DB::table('voluntarios')->where('eliminado', '=', false)->count(); 
            $instituciones = DB::table('instituciones')->where('activo', '=', true)->count();   
            $jornadas = DB::table('jornadas')->where('activo', '=', true)->count();   
            $centros = DB::table('sedes')->where('activo', '=', true)->count();   
            $usuarios = DB::table('usuarios')->where('activo', '=', true)->count();   

            return view('admin.index', compact('voluntarios', 'instituciones', 'jornadas', 'centros', 'usuarios'), $data);

        }else{
            $id_user = session('LoggedUser');
            $id = DB::table('usuarios')->where('id_user', '=', $id_user)->value('id_insti'); 
            $voluntarios = DB::table('voluntarios')->where('id_insti', '=', $id)->where('eliminado', '=', false)->count(); 
            $jornadas = DB::table('detalle_jornadas')
            ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
            ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
            ->select(
                'voluntarios.id_voluntario AS id_voluntario',              
                'voluntarios.nombre AS nombre',
                'voluntarios.ape_pat AS ape_pat',
                'voluntarios.ape_mat AS ape_mat',
                'voluntarios.email AS email',
                'voluntarios.tel AS tel',
                'voluntarios.curp AS curp',
                'instituciones.nombre AS nombre_institucion',
                'municipios.nombre AS nombre_municipio'
            )
            ->where('voluntarios.id_insti', '=', $id)
            ->distinct()
            ->count();

            return view('admin.index', compact('voluntarios', 'jornadas'), $data); 
        }
    
    }
}
