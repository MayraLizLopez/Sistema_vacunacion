<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Voluntario;
use App\Models\Municipio;
use App\Models\Institucion;
use App\Models\Sede;
use App\Models\Usuario;
use App\Models\DetalleJornada;
use App\Mail\SaveVoluntario;
use Carbon\Carbon;

class SedeController extends Controller
{
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $municipios = DB::table('municipios')->get();   
        return view('admin.sedes.create', compact('municipios'), $data);
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
            'direccion' => 'required',
            'id_municipio' => 'required',
            'cupo' => 'required',
        ]);

        $sede = new Sede;
        $sede ->nombre = $request->nombre;
        $sede ->direccion = $request->direccion;
        $sede->id_municipio = (int)$request->id_municipio;
        $sede->cupo = (int)$request->cupo;
        $sede->activo = true;
        $sede->fecha_creacion = Carbon::now();
        $save = $sede->save();

        if($save){
            return back()->with('success', '¡El centro fue registrados correctamente!');
        }else{
            return back()->with('fail', 'Error al registrar el centro');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $rol = session('LoggedUserNivel');
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $sedes = DB::table('sedes')
        ->join('municipios', 'sedes.id_municipio', '=', 'municipios.id_municipio')
        ->select('sedes.*', 'municipios.nombre AS nombre_municipio', 'municipios.id_municipio AS id_municipio')
        ->where('sedes.activo', '=', 1)
        ->get();
    
        return view('admin.sedes.index', compact('sedes'), $data);
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
        $sede = DB::table('sedes')->where('id_sede', $id)->first();    
        $municipios = DB::table('municipios')->get();   
        $muni = DB::table('municipios')->where('id_municipio', $sede->id_municipio)->first();   
        $municipio_select = $muni->nombre;
        return view('admin.sedes.edit', compact('sede', 'municipios', 'municipio_select'), $data);
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
            'direccion' => 'required',
            'id_municipio' => 'required',
            'cupo' => 'required',
        ]);

        $sedeEditado = Sede::findOrFail($id);
        $sedeEditado->nombre = $request->nombre;
        $sedeEditado->direccion = $request->direccion;
        $sedeEditado->id_municipio = (int)$request->id_municipio;
        $sedeEditado->activo = true;
        $sedeEditado->fecha_edicion = Carbon::now();
        $save = $sedeEditado->save();
        
        if($save){
            return back()->with('success', '¡Los datos del centro fueron actualizados correctamente!');
        }else{
            return back()->with('fail', 'Error al actualizar los datos del centro');
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
        $sedeEliminar = Sede::findOrFail($id);
        $sedeEliminar->activo = false;
        $save = $sedeEliminar->save();
        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡El centro fue eliminado correctamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => false,
                'message' => 'Error al eliminar el centro'
            ]);
        }
    }

}
