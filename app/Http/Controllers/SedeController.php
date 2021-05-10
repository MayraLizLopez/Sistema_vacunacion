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
     * Método que redirreciona a la vista de registro de centros, teniendo como carga inicial municipios.
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
     * Método que permite el guardado del registro de Centros En caso de que el registro sea realizado correctamente se retorna "success", en caso contrario "fail".
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validación de campos
        $request->validate([
            'nombre' => 'required', 
            'direccion' => 'required',
            'id_municipio' => 'required',
            'cupo' => 'required',
            'colonia' => 'required',
            'cp' => 'required',
            'cruce_calles' => 'required',
            'nombre_encargado' => 'required',
        ]);

        $sede = new Sede;
        $sede ->nombre = $request->nombre;
        $sede ->direccion = $request->direccion;
        $sede->id_municipio = (int)$request->id_municipio;
        $sede->colonia = $request->colonia;
        $sede->cp = $request->cp;
        $sede->cruce_calles = $request->cruce_calles;
        $sede->georeferencia = $request->georeferencia;
        $sede->nombre_encargado = $request->nombre_encargado;
        $sede->tel_encargado = $request->tel_encargado;
        $sede->email_encargado = $request->email_encargado;
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
     * Método que redirecciona a la vista principal de Centros donde se muestra una tabla con todos los registros activos.
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
        $municipios = DB::table('municipios')->get();   
        $muni = DB::table('municipios')->where('id_municipio', 40)->first();   
        $municipio_select = $muni->nombre;
    
        return view('admin.sedes.index', compact('sedes', 'municipios'), $data);
    }

     /**
     * Método que redirecciona a la vista de edición de un Centro, teniendo como carga inicial municipios y los datos del Centro a editar.
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
     * Método que permite la actualización de datos del centro. Retornando "success" si el registro fue actualizado correctamente o "fail" en caso contrario.
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
            'colonia' => 'required',
            'cp' => 'required',
            'cruce_calles' => 'required',
            'nombre_encargado' => 'required',
        ]);

        $sedeEditado = Sede::findOrFail($id);
        $sedeEditado->nombre = $request->nombre;
        $sedeEditado->direccion = $request->direccion;
        $sedeEditado->id_municipio = (int)$request->id_municipio;
        $sedeEditado->colonia = $request->colonia;
        $sedeEditado->cp = $request->cp;
        $sedeEditado->cruce_calles = $request->cruce_calles;
        $sedeEditado->georeferencia = $request->georeferencia;
        $sedeEditado->nombre_encargado = $request->nombre_encargado;
        $sedeEditado->tel_encargado = $request->tel_encargado;
        $sedeEditado->email_encargado = $request->email_encargado;
        $sedeEditado->activo = true;
        $sedeEditado->fecha_edicion = Carbon::now();
        $sedeEditado->latitud = null;
        $sedeEditado->longitud= null;
        $save = $sedeEditado->save();
        
        if($save){
            return back()->with('success', '¡Los datos del centro fueron actualizados correctamente!');
        }else{
            return back()->with('fail', 'Error al actualizar los datos del centro');
        }
    }

    /**
     * Método que permite el borrado lógico de un centro, cambiando el campo "activo" a false
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

    /**
     * Método que retorna los detalles de la sede seleccionada.
     */
    public function  getDetalleSede($id_sede){
        $sedes = DB::table('sedes')
        ->join('municipios', 'sedes.id_municipio', '=', 'municipios.id_municipio')
        ->select('sedes.*', 'municipios.nombre AS nombre_municipio', 'municipios.id_municipio AS id_municipio')
        ->where('sedes.id_sede', '=', $id_sede)
        ->first();

        return response()->json([
            'data' => $sedes    
        ]);
    }

    /**
     * Método que almacena las coordenadas de una sede que no tiene coordenadas
     */
    public function  saveCoordenadas(Request $request){
        $request->validate([
            'latitud' => 'required', 
            'longitud' => 'required',
        ]);

        $sedeEditado = Sede::findOrFail($request->id_sede);
        $sedeEditado->latitud = $request->latitud;
        $sedeEditado->longitud = $request->longitud;
        $sedeEditado->fecha_edicion = Carbon::now();
        $save = $sedeEditado->save();
        
        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡Geolocalización guardada correctamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => false,
                'message' => 'Error al guardar la geolocalización'
            ]);
        }
    }

}
