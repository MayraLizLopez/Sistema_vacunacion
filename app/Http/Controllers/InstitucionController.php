<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;
use App\Models\Voluntario;
use Illuminate\Support\Facades\Hash;    
use App\Models\Usuario;
use Carbon\Carbon;

class InstitucionController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Método de redireccionando a la vista de registroro de Instituciones, consulta los municipios como carga inicial
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Variable que almanece los datos del usuario logeado
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $municipios = DB::table('municipios')->get();   
        return view('admin.create_institutions', compact('municipios'), $data);
    }

    /**
     * Método para el guardado de la institución en el registro. Retornando "success" si el registro se guardo con éxito y "fail" en caso contrario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required', 
            'domicilio' => 'required',
            'id_municipio' => 'required',
            'nombre_enlace' => 'required',
            'ape_pat' => 'required', 
            'cargo_enlace' => 'required', 
            'password' => 'required', 
            'email' => 'required|email|unique:usuarios', 
            'tel' => 'required',
        ]);

        $institucion = new Institucion;
        $institucion->nombre = $request->nombre;
        $institucion->domicilio = $request->domicilio;
        $institucion->id_municipio = (int)$request->id_municipio;
        $institucion->activo = true;
        $institucion->fecha_creacion = Carbon::now();
        $save = $institucion->save();
        
        $usuario = new Usuario;
        $usuario->nombre = $request->nombre_enlace;
        $usuario->ape_pat = $request->ape_pat;
        $usuario->ape_mat = $request->ape_mat;
        $usuario->id_insti = $institucion->id_insti;
        $usuario->cargo = $request->cargo_enlace;
        $usuario->rol = 'Enlace de institución';
        $usuario->tel = $request->tel;
        $usuario->email = $request->email;
        $usuario->activo = true;
        $usuario->password = Hash::make($request->password);
        $usuario->fecha_creacion = Carbon::now();
        $save1 = $usuario->save();
        
        $institucion->id_user = $usuario->id_user;
        $save = $institucion->save();

        if($save && $save1){
            return back()->with('success', '¡La institución y el enlace fue registrados correctamente!');
        }else{
            return back()->with('fail', 'Error al registrar la institución y/o al enlace');
        }
    }

    /**
     * Método de redireccionando a la vista inicial de las instituciones donde se realizan consultas para obtener los datos a mostrar en la tabla de instituciones
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //Variable que almanece los datos del usuario logeado
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $instituciones = DB::table('instituciones')
        ->join('municipios', 'instituciones.id_municipio', '=', 'municipios.id_municipio')
        ->join('usuarios', 'instituciones.id_user', '=', 'usuarios.id_user')
        ->select('instituciones.*', 'municipios.nombre AS nombre_municipio', 'usuarios.nombre AS nombre_enlace', 'usuarios.email AS email', 'usuarios.tel AS tel')
        ->where('instituciones.activo', '=', 1)
        ->get();
        return view('admin.Institutions', compact('instituciones'), $data);
    }

    /**
     * Método de redireccionado a la vista de edición de una institución, teniendo como carga inicial los municipios y los datos de la institución a editar
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Variable que almanece los datos del usuario logeado
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $institucion = DB::table('instituciones')->where('id_insti', $id)->first();  
        $usuario = DB::table('usuarios')->where('id_user', $institucion->id_user)->first();   
        $usuarios = DB::table('usuarios')->where('rol', '=', 'Enlace de institución')->orderBy('nombre', 'asc')->get();
        $municipios = DB::table('municipios')->get();   
        $muni = DB::table('municipios')->where('id_municipio', $institucion->id_municipio)->first();   
        $municipio_select = $muni->nombre;
        $i=0;
        return view('admin.edit_institutions', compact('institucion', 'municipios', 'municipio_select', 'usuario', 'usuarios', 'i'), $data);
    }

    /**
     * Método que permite guardar los datos de la edición de la institución. Retornando "success" si el registro se guardo con éxito y "fail" en caso contrario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        //Validación de campos
        $request->validate([
            'nombre' => 'required', 
            'domicilio' => 'required',
            'id_municipio' => 'required',
            'nombre_enlace' => 'required', 
            'email2' => 'required', 
        ]);
        
        $institucionEditado = Institucion::findOrFail($id);
        $usuarioNuevo = DB::table('usuarios')->where('email', '=', $request->email2)->first();
        $usuario = Usuario::findOrFail($institucionEditado->id_user);
        if(($usuario->nombre != $request->nombre_enlace) || ($usuario->cargo != $request->cargo_enlace) || ($usuario->email != $request->email) || ($usuario->tel != $request->tel)){
            $institucionEditado->id_user = $usuarioNuevo->id_user;
        }
        $institucionEditado->nombre = $request->nombre;
        $institucionEditado->domicilio = $request->domicilio;
        $institucionEditado->id_municipio = (int)$request->id_municipio;
        //$institucionEditado->activo = true;
        $institucionEditado->fecha_edicion = Carbon::now();
        $save = $institucionEditado->save();
        
        if($save){
            return back()->with('success', '¡Los datos de la institución fueron actualizados correctamente!');
        }else{
            return back()->with('fail', 'Error al actualizar los datos de la institución');
        }
    }

    /**
     * Método que permite la eliminación lógica de una institución cambiando el campo "activo" a false. Retornando "success" si se realizo el cambio correctamente y "fail" en caso contrario.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $InstitucionEliminar = Institucion::findOrFail($id);
        $InstitucionEliminar->activo = false;
        $save = $InstitucionEliminar->save();
        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡La Institución fue eliminada correctamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => false,
                'message' => 'Error al eliminar la Institución'
            ]);
        }
    }

    /**
     * Método que consulta a todos los enlaces de las instituciones
     */
    public function consultaEnlaces(){
        $enlaces = DB::table('instituciones')
        ->join('usuarios', 'instituciones.id_user', '=', 'usuarios.id_user')
        ->select('usuarios.*', 'instituciones.nombre AS nombre Institucion')
        ->where('instituciones.activo', '=', 1)
        ->orderBy('instituciones.nombre', 'ASC')
        ->get();
    }

    public function enviarCorreo(){
        
    }
}
