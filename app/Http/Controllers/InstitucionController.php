<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;
use Illuminate\Support\Facades\Hash;    
use App\Models\Usuario;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $municipios = DB::table('municipios')->get();   
        return view('admin.create_institutions', compact('municipios'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $municipios = DB::table('municipios')->get();   
        return view('admin.create_institutions', compact('municipios'), $data);
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
        $institucion->nombre_enlace = $request->nombre_enlace . ' ' . $request->ape_pat . ' ' . $request->ape_mat;
        $institucion->cargo_enlace = $request->cargo_enlace;
        $institucion->id_municipio = (int)$request->id_municipio;
        $institucion->tel = $request->tel;
        $institucion->email = $request->email;
        $institucion->activo = true;
        //$institucion->password = Hash::make($request->password);
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
        $save1 = $usuario->save();

        if($save && $save1){
            return back()->with('success', '¡La institución fue registrada correctamente!');
        }else{
            return back()->with('fail', 'Error al registrar la institución');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $instituciones = DB::table('instituciones')
        ->join('municipios', 'instituciones.id_municipio', '=', 'municipios.id_municipio')
        ->select('instituciones.*', 'municipios.nombre AS nombre_municipio')
        ->where('instituciones.activo', '=', 1)
        ->get();
        return view('admin.institutions', compact('instituciones'), $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $institucion = DB::table('instituciones')->where('id_insti', $id)->first();   
        $municipios = DB::table('municipios')->get();   
        $muni = DB::table('municipios')->where('id_municipio', $institucion->id_municipio)->first();   
        $municipio_select = $muni->nombre;
        return view('admin.edit_institutions', compact('institucion', 'municipios', 'municipio_select'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'nombre' => 'required', 
            'domicilio' => 'required',
            'id_municipio' => 'required',
            'nombre_enlace' => 'required', 
            'cargo_enlace' => 'required', 
            'tel' => 'required',
            'email' => 'required|email', 
        ]);

        $institucionEditado = Institucion::findOrFail($id);
        $institucionEditado->nombre = $request->nombre;
        $institucionEditado->domicilio = $request->domicilio;
        $institucionEditado->id_municipio = (int)$request->id_municipio;
        $institucionEditado->nombre_enlace = $request->nombre_enlace;
        $institucionEditado->cargo_enlace = $request->cargo_enlace;
        $institucionEditado->email = $request->email;
        $institucionEditado->tel = $request->tel;
        $institucionEditado->activo = true;
        $save = $institucionEditado->save();
        if($save){
            return back()->with('success', '¡Los datos de la institución fueron actualizados correctamente!');
        }else{
            return back()->with('fail', 'Error al actualizar los datos de la institución');
        }
    }

    /**
     * Remove the specified resource from storage.
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
}
