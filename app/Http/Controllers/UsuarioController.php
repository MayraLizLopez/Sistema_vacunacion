<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;
use App\Models\Municipio;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SaveVoluntario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()];
        $usuarios =  DB::table('usuarios')
        ->join('instituciones', 'usuarios.id_insti', '=', 'instituciones.id_insti')
        ->select('usuarios.*', 'instituciones.nombre AS nombre_institucion')
        ->where('usuarios.activo', true)
        ->orderBy('usuarios.nombre')
        ->get();
        return view('admin.users.index', compact('usuarios'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituciones =  DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('users.registration', compact('instituciones'));
    }

    public function createAdmin()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('admin.users.create', compact('instituciones'), $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'nombre' => 'required', 
        'ape_pat' => 'required', 
        'email' => 'required|email|unique:usuarios', 
        'tel' => 'required',
        'cargo' => 'required',
        'rol' => 'required',
        'id_insti' => 'required', 
        'password' => 'required' 
        ]);

        $usuario = new Usuario;
        $usuario->nombre = $request->nombre;
        $usuario->ape_pat = $request->ape_pat;
        $usuario->ape_mat = $request->ape_mat;
        $usuario->id_insti = $request->id_insti;
        $usuario->cargo = $request->cargo;
        $usuario->rol = $request->rol;
        $usuario->tel = $request->tel;
        $usuario->email = $request->email;
        $usuario->activo = true;
        $usuario->password = Hash::make($request->password);
        $usuario->fecha_creacion = Carbon::now();
        $save = $usuario->save();

        if($save){
            return redirect()->back()->with('success', '¡Usuario registrado correctamente!');
        }else{
            return redirect()->back()->with('fail', 'No se pudo crear el usuario');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $id =  session('LoggedUser');
        $user = DB::table('usuarios')->where('id_user', $id)->first();
        $institucion = DB::table('instituciones')->where('id_insti', $user->id_insti)->first();
        
        return view('admin.Profile', compact('user', 'institucion'), $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $userEdit = DB::table('usuarios')->where('id_user', $id)->first();

        $instituciones = DB::table('instituciones')->get();   
        $insti = DB::table('instituciones')->where('id_insti', $userEdit->id_insti)->first();
        $institucion_select = $insti->nombre;

        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('admin.users.edit', compact('userEdit', 'instituciones', 'institucion_select'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required', 
            'ape_pat' => 'required', 
            'email' => 'required|email', 
            'tel' => 'required',
            'cargo' => 'required',
            'rol' => 'required',
            'id_insti' => 'required'
            ]);
    
            $usuario = Usuario::findOrFail($id);
            $usuario->nombre = $request->nombre;
            $usuario->ape_pat = $request->ape_pat;
            $usuario->ape_mat = $request->ape_mat;
            $usuario->id_insti = (int)$request->id_insti;
            $usuario->cargo = $request->cargo;
            $usuario->rol = $request->rol;
            $usuario->tel = $request->tel;
            $usuario->email = $request->email;
            $usuario->fecha_edicion = Carbon::now();
            $save = $usuario->save();

            // DB::table('usuarios')
            // ->where('id_user', $id)
            // ->update([
            //     'nombre' => $request->nombre,
            //     'ape_pat' => $request->ape_pat,
            //     'ape_mat' => $request->ape_mat,
            //     'id_insti' => $request->id_insti,
            //     'cargo' => $request->cargo,
            //     'rol' => $request->rol,
            //     'tel' => $request->tel,
            //     'email' => $request->email,
            //     'fecha_edicion' => $request->fecha_edicion
            // ]);
    
            if($save){
                return redirect()->back()->with('success', '¡Usuario actualizado correctamente!');
            }else{
                return redirect()->back()->with('fail', 'No se pudo actualizar el usuario');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_user)
    {
        DB::table('usuarios')
        ->where('id_user', $id_user)
        ->update([
            'activo' => false
        ]);

        return response()->json([
            'isOk' => true,
            'message' => '¡El usuario fue deshabilitado correctamente!'
        ]);          
    }

    public function build($id_user)
    {
        DB::table('usuarios')
        ->where('id_user', $id_user)
        ->update([
            'activo' => true
        ]);

        return response()->json([
            'isOk' => true,
            'message' => '¡El usuario fue habilitado correctamente!'
        ]);          
    }

    public function getAllActiveUsers(){
        $usuarios =  DB::table('usuarios')
        ->join('instituciones', 'usuarios.id_insti', '=', 'instituciones.id_insti')
        ->select('usuarios.*', 'instituciones.nombre AS nombre_institucion')
        ->where('usuarios.activo', 1)
        ->orderBy('usuarios.nombre')
        ->get();

        return response()->json([
            'data' => $usuarios       
        ]); 
    }

    public function getAllInactiveUsers(){
        $usuarios =  DB::table('usuarios')
        ->join('instituciones', 'usuarios.id_insti', '=', 'instituciones.id_insti')
        ->select('usuarios.*', 'instituciones.nombre AS nombre_institucion')
        ->where('usuarios.activo', 0)
        ->orderBy('usuarios.nombre')
        ->get();

        return response()->json([
            'data' => $usuarios       
        ]); 
    }

    public function getAllInstitutions()
    {   
        $institutions = DB::table('instituciones')->where('activo', '=', 1)
        ->orderBy('nombre')
        ->get();
        return response()->json([
            'data' => $institutions       
        ]); 
    }

    public function searchByUser($name){
        $users =  DB::table('usuarios')
        ->join('instituciones', 'usuarios.id_insti', '=', 'instituciones.id_insti')
        ->select('usuarios.*', 'instituciones.nombre AS nombre_institucion')
        ->where('usuarios.nombre', $name)
        ->orderBy('usuarios.nombre')
        ->get();
        
        return response()->json([
            'data' => $users         
        ]); 
    }

    public function searchByRol($name){
        $users =  DB::table('usuarios')
        ->join('instituciones', 'usuarios.id_insti', '=', 'instituciones.id_insti')
        ->select('usuarios.*', 'instituciones.nombre AS nombre_institucion')
        ->where('usuarios.rol', $name)
        ->orderBy('usuarios.nombre')
        ->get();
        
        return response()->json([
            'data' => $users         
        ]); 
    }

    public function searchByInstitution($id_institution){
        $users =  DB::table('usuarios')
        ->join('instituciones', 'usuarios.id_insti', '=', 'instituciones.id_insti')
        ->select('usuarios.*', 'instituciones.nombre AS nombre_institucion')
        ->where('usuarios.id_insti', $id_institution)
        ->orderBy('usuarios.nombre')
        ->get();
        
        return response()->json([
            'data' => $users         
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function savePassword($pass)
    {
        // return response()->json([
        //     'data' => $pass         
        // ]); 
        $id =  session('LoggedUser');
        $user = Usuario::findOrFail($id);
        $user->password = Hash::make($pass);
        $save = $user->save();     
        
        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡La contraseña fue cambiada correctamente!'
            ]);    
        }
    }
}
