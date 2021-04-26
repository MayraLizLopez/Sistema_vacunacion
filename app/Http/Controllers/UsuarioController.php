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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request)
        $this->validate($request, 
        ['nombre' => 'required', 
        'ape_pat' => 'required', 
        'email' => 'required', 
        'tel' => 'required',
        'id_insti' => 'required', 
        'password' => 'requered']);

        $emailUnico = DB::select('SELECT COUNT(*) FROM usuarios WHERE email = '.$request->input('email'));
        if($emailUnico == 0){
            DB::insert('insert into usuarios (nombre, ape_pat, ape_mat, id_insti, cargo, rol, tel, email, password, activo) values(?,?,?,?,?,?,?,?,?,?)', 
            [$request->input('nombre'), $request->input('ape_pat'), $request->input('ape_mat'), (int)$request->input('id_insti'), $request->input('cargo'), $request->input('rol'), $request->input('tel'), $request->input('email'),  $request->input('password'), true]);
            $mensaje = "success";

            return redirect()->route('/');
        }else{
            $mensaje = "El email ya fue registrado";
            $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
            
            return view('voluntarios', compact('instituciones', 'mensaje'));
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
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
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
    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required', 
        ]);
        
        $id =  session('LoggedUser');
        $user = Usuario::findOrFail($id);
        $user->password = Hash::make($request->password);
        $save = $user->save();     
        
        if($save){
            return redirect()->back()->with('success', '¡Tus datos fueron agregados correctamente, te enviamos un correo a tu email!');
        }else{
            return redirect()->back()->with('fail', 'tus datos no puedieron ser agregados correctamente');
        }
    }
}
