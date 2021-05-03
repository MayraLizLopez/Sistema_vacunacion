<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Usuario;
use App\Models\Voluntario;
use App\Models\Jornada;
use App\Models\DetalleJornada;

use App\Mail\ConfirmJornada;
use Illuminate\Support\Facades\Mail;

class VaccinationDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        return view("admin.vaccinationDay.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'fecha_inicio' => 'required', 
            'fecha_fin' => 'required',
            'mensaje' => 'required',
            'idsVoluntarios' => 'required',
            'idSedes' => 'required'
        ]);
        
        $jornada = new Jornada;
        //$jornada->folio = 'F000';
        $jornada->fecha_inicio = $request->fecha_inicio;
        $jornada->fecha_fin = $request->fecha_fin;
        $jornada->mensaje = $request->mensaje;
        $jornada->activo = true;
        $jornada->fecha_creacion = Carbon::now();
        $save = $jornada->save();

        foreach($request->idSedes as $id_sede){
            foreach($request->idsVoluntarios as $id_voluntario){
                $detalle_jornada = new DetalleJornada;
                $detalle_jornada->id_jornada = $jornada->id_jornada;
                $detalle_jornada->id_voluntario = (int)$id_voluntario;
                $detalle_jornada->uuid = DB::raw('UUID()');
                $detalle_jornada->id_sede = (int)$id_sede;
                $detalle_jornada->horas = 0;
                $detalle_jornada->correo_enviado = false;
                $detalle_jornada->eliminado = false;
                $save1 = $detalle_jornada->save();
            }
        }

        if($save && $save1){
            return response()->json([
                'isOk' => true,
                'message' => '¡La jornada fue guardada exitosamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => true,
                'message' => 'Error al registrar la jornada'       
            ]); 
        }

        // return response()->json([
        //     'isOk' => true,
        //     'message' => $request->idSedes
        // ]);
    }

    /**
     * Show all jornadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $jornadas = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('sedes', 'detalle_jornadas.id_sede', '=', 'sedes.id_sede')
        ->join('municipios', 'sedes.id_municipio', '=', 'municipios.id_municipio')
        ->select(
            'jornadas.id_jornada AS id_jornada',
            'jornadas.fecha_inicio AS fecha_inicio',
            'jornadas.fecha_fin AS fecha_fin' ,
            'municipios.id_municipio AS id_municipio',
            'municipios.nombre AS nombre_municipio',    
            DB::raw('COUNT(DISTINCT detalle_jornadas.id_voluntario) as total_voluntarios'),
            DB::raw("group_concat(DISTINCT sedes.nombre SEPARATOR ', ') as nombres_sedes"))
        ->where('jornadas.activo', '=', true)
        ->groupBy('jornadas.id_jornada', 'id_municipio')
        ->get();


        return response()->json([
            'data' => $jornadas        
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_jornada' => 'required',
            'fecha_inicio' => 'required', 
            'fecha_fin' => 'required',
            'mensaje' => 'required',
            'idsVoluntarios' => 'required',
            'idSedes' => 'required'
        ]);
        
        DB::table('jornadas')
        ->where('id_jornada', $request->id_jornada)
        ->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'mensaje' => $request->mensaje
        ]);

        DB::table('detalle_jornadas')
        ->where('id_jornada', '=', $request->id_jornada)
        ->delete();

        foreach($request->idSedes as $id_sede){
            foreach($request->idsVoluntarios as $id_voluntario){
                $detalle_jornada = new DetalleJornada;
                $detalle_jornada->id_jornada = $request->id_jornada;
                $detalle_jornada->id_voluntario = (int)$id_voluntario;
                $detalle_jornada->uuid = DB::raw('UUID()');
                $detalle_jornada->id_sede = (int)$id_sede;
                $detalle_jornada->horas = 0;
                $detalle_jornada->correo_enviado = false;
                $detalle_jornada->eliminado = false;
                $save1 = $detalle_jornada->save();
            }
        }

        if($save1){
            return response()->json([
                'isOk' => true,
                'message' => '¡La jornada fue actualizada exitosamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => true,
                'message' => 'Error al editar la jornada'       
            ]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('jornadas')
        ->where('id_jornada', $request->id_jornada)
        ->update([
            'activo' => false
        ]);

        return response()->json([
            'isOk' => true,
            'message' => '¡La jornada fue eliminada exitosamente!'
        ]);
    }

    public function getVoluntariesByInstitution(Request $request){
        $voluntarios = DB::table('voluntarios')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('voluntarios.*',
         'instituciones.id_municipio AS id_instituciones_municipio',
         'instituciones.nombre AS nombre_institucion',
         'municipios.nombre AS nombre_municipio')
        ->where([['eliminado', '=', 0],
                ['voluntarios.activo', '=', 0]])
        ->whereIn('voluntarios.id_insti', $request->ids_institution)
        ->get();
        return response()->json([
            'data' => $voluntarios       
        ]); 
    }

    public function getJornada($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->select(               
                'jornadas.id_jornada AS id_jornada',
                'jornadas.fecha_inicio AS fecha_inicio',
                'jornadas.fecha_fin AS fecha_fin',
                'jornadas.mensaje AS mensaje'
        )
        ->where('detalle_jornadas.id_jornada', '=', $id_jornada)
        ->first();

        return response()->json([
            'data' => $jornadas        
        ]); 
    }

    public function getJornadaForVoluntaries($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select(
            'id_detalle_jornada',               
            'voluntarios.id_voluntario as id_voluntario',
            'voluntarios.nombre AS nombre',
            'voluntarios.ape_pat AS ape_pat',
            'voluntarios.ape_mat AS ape_mat',
            'voluntarios.tel AS tel',
            'voluntarios.email AS email',
            'instituciones.nombre AS nombre_institucion',
            'municipios.nombre AS nombre_municipio'
        )
        ->where('detalle_jornadas.id_jornada', '=', $id_jornada)
        ->where('detalle_jornadas.correo_enviado', '=', 0)
        ->get();

        return response()->json([
            'data' => $jornadas        
        ]);
    }

    public function getJornadaForSedes($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('sedes', 'detalle_jornadas.id_sede', '=', 'sedes.id_sede')
        ->select(
            'id_detalle_jornada',               
            'sedes.id_sede AS id_sede',
            'sedes.nombre AS nombre',
            'sedes.direccion AS direccion',
            'sedes.cupo AS cupo'
        )
        ->where('detalle_jornadas.id_jornada', '=', $id_jornada)
        ->where('detalle_jornadas.correo_enviado', '=', 0)
        ->get();

        return response()->json([
            'data' => $jornadas        
        ]);
    }

    public function getJornadaDetail($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->select(
            'detalle_jornadas.id_voluntario AS id_voluntario',
            'detalle_jornadas.id_detalle_jornada AS id_detalle_jornada',
            'voluntarios.nombre AS nombre',
            'voluntarios.ape_pat AS ape_pat',
            'voluntarios.ape_mat AS ape_mat',
            'voluntarios.tel AS tel',
            'voluntarios.email AS email',
            'instituciones.nombre AS nombre_institucion',
            'municipios.nombre AS nombre_municipio'
        )
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->where('detalle_jornadas.id_jornada', '=', $id_jornada)
        ->where('detalle_jornadas.correo_enviado', '=', 0)
        ->get();

        return response()->json([
            'data' => $jornadas      
        ]);
    }

    public function getLastJornada(){
        $jornadas = DB::table('jornadas')->latest('id_jornada')->first();
        return response()->json([
            'data' => $jornadas        
        ]); 
    }

    public function getAllInstitutions()
    {  
        $institutions = DB::table('instituciones')
        ->join('municipios', 'instituciones.id_municipio', '=', 'municipios.id_municipio')
        ->select('instituciones.*', 'municipios.nombre AS nombre_municipio')
        ->where('instituciones.activo', '=', 1)
        ->orderBy('instituciones.nombre', 'asc')
        ->get();
        return response()->json([
            'data' => $institutions       
        ]); 
    }

    public function getAllTowns()
    {  
        $towns = DB::table('municipios')
        ->orderBy('nombre', 'asc')
        ->get();
        return response()->json([
            'data' => $towns          
        ]); 
    }

   public function getAllSedesByIdTown($id_municipio){
        $jornadas = DB::table('sedes')
        ->join('municipios', 'sedes.id_municipio', '=', 'municipios.id_municipio')
        ->select('sedes.*', 'municipios.nombre AS nombre_municipio')
        ->where('sedes.id_municipio', '=', $id_municipio)
        ->get();
        return response()->json([
            'data' => $jornadas        
        ]); 
    }

    public function enviarCorreoJornada(Request $request){ 
        if(count($request->ids_detalle_jornadas) != 0){  
            $detalle_jornada = DB::table('detalle_jornadas')->where('id_detalle_jornada', '=', (int)$request->ids_detalle_jornadas[0])->first();
            $jornada = DB::table('jornadas')->where('id_jornada', '=', $detalle_jornada->id_jornada)->first();
            for ($j = 0; $j < count($request->ids_detalle_jornadas); $j++) {
                $detalle_jornadas = DB::table('detalle_jornadas')->where('id_detalle_jornada', '=', (int)$request->ids_detalle_jornadas[$j])->first();
                $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detalle_jornadas->id_voluntario)->first();
                //$sedes = DB::table('detalle_jornadas')->where('id_voluntario', '=', $voluntario->id_voluntario)->where('id_jornada', '=', $detalle_jornadas->id_jornada)->get();
                $sedes = DB::table('detalle_jornadas')
                ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
                ->join('sedes', 'detalle_jornadas.id_sede', '=', 'sedes.id_sede')
                ->select(
                    'id_detalle_jornada',               
                    'sedes.id_sede AS id_sede',
                    'sedes.nombre AS nombre',
                    'sedes.direccion AS direccion',
                    'sedes.colonia AS colonia',
                    'sedes.cupo AS cupo',
                    'uuid' 
                )
                ->where('detalle_jornadas.id_jornada', '=',  $detalle_jornadas->id_jornada)
                ->where('detalle_jornadas.id_voluntario', '=',  $voluntario->id_voluntario)
                ->get();
                $data = [
                    'uuid' => $detalle_jornada->uuid,
                    'nombre' => $voluntario->nombre . ' ' . $voluntario->ape_pat . ' ' . $voluntario->ape_mat,
                    'id_voluntario' => $voluntario->id_voluntario, 
                    'id_jornada' => $detalle_jornadas->id_jornada,
                    'mensaje' => $jornada->mensaje,
                    'sedes' => $sedes,
                ];

                Mail::to($voluntario->email)->send(new ConfirmJornada($data));
                 
                for($k = 0; $k < count($sedes); $k++){
                    $editarJornada = DetalleJornada::findOrFail($sedes[$k]->id_detalle_jornada);
                    $editarJornada->correo_enviado = true;
                    $editarJornada->save();
                }
            }
            return response()->json([
                'mensaje' => 'Correos enviados',
            ]); 
        }

    }

    public static function rechazarJornada($uuid){
        $detallejornada = DB::table('detalle_jornadas')->where('uuid', '=', $uuid)->first();
        if($detallejornada->activo == null){
            $detalles = DB::table('detalle_jornadas')->where('id_jornada', '=', $detallejornada->id_jornada)->where('id_voluntario', '=', $detallejornada->id_voluntario)->get();
            for ($i=0; $i<count($detalles); $i++){
                if($detalles[$i]->activo == null){
                    $jornada = DetalleJornada::findOrFail($detalles[$i]->id_detalle_jornada);
                    $jornada->activo = false;
                    $save = $jornada->save();   
                }
            }
            $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
            if($save){
                return view('volunteers.rechazarJornada', compact('voluntario'));
            }
        }
    }

    public static function aceptarJornada($uuid){
        $detallejornada = DB::table('detalle_jornadas')->where('uuid', '=', $uuid)->first();
            if($detallejornada->activo == null){
            $jornada = DetalleJornada::findOrFail($detallejornada->id_detalle_jornada);
            $jornada->activo = true;
            $save = $jornada->save();
            $detalles = DB::table('detalle_jornadas')->where('id_jornada', '=', $detallejornada->id_jornada)->where('id_voluntario', '=', $detallejornada->id_voluntario)->get();
            for ($i=0; $i<count($detalles); $i++){
                if($detalles[$i]->activo == null){
                    $jornada = DetalleJornada::findOrFail($detalles[$i]->id_detalle_jornada);
                    $jornada->activo = false;
                    $save = $jornada->save();   
                }
            }
            $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
            if($save){
                return view('volunteers.aceptarjornada', compact('voluntario'));
            }
        }
    }
}