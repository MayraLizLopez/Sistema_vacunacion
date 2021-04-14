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
            'idsVoluntarios' => 'required'
        ]);
        
        $jornada = new Jornada;
        $jornada->fecha_inicio = $request->fecha_inicio;
        $jornada->fecha_fin = $request->fecha_fin;
        $jornada->mensaje = $request->mensaje;
        $jornada->activo = true;
        $jornada->fecha_creacion = Carbon::now();
        $save = $jornada->save();

        foreach($request->idsVoluntarios as $data){
            $detalle_jornada = new DetalleJornada;
            $detalle_jornada->id_jornada = $jornada->id_jornada;
            $detalle_jornada->id_voluntario = (int)$data;
            $detalle_jornada->uuid = DB::raw('UUID()');
            $detalle_jornada->activo = false;
            $detalle_jornada->eliminado = false;
            $save1 = $detalle_jornada->save();
        }

        if($save && $save1){
            return response()->json([
                'isOk' => true,
                'message' => '¡La jornada fue guardada exitosamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => true,
                'message' => 'Error al registrar la institución'       
            ]); 
        }
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
        ->select(
            'jornadas.id_jornada',
            'jornadas.fecha_inicio',
            'jornadas.fecha_fin',
            DB::raw('COUNT(detalle_jornadas.id_detalle_jornada) as total_voluntarios'))
        ->where('jornadas.activo', '=', true)
        ->groupBy('jornadas.id_jornada')
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
            'idsVoluntarios' => 'required'
        ]);
        
        DB::table('jornadas')
        ->where('id_jornada', $request->id_jornada)
        ->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'mensaje' => $request->mensaje
        ]);

        for ($i = 0; $i < count($request->idsVoluntarios); $i++) {
            $exist_id_voluntary = DB::table('detalle_jornadas')
            ->where('id_voluntario', '=', (int)$request->idsVoluntarios[$i])
            ->where('id_jornada', '=', $request->id_jornada)
            ->count();

            if($exist_id_voluntary == 0){
                $detalle_jornada = new DetalleJornada;
                $detalle_jornada->id_jornada = $request->id_jornada;
                $detalle_jornada->id_voluntario = (int)$request->idsVoluntarios[$i];
                $detalle_jornada->uuid = DB::raw('UUID()');
                $detalle_jornada->activo = false;
                $detalle_jornada->eliminado = false;
                $detalle_jornada->save();           
            }else{
                DB::table('detalle_jornadas')
                ->where('id_voluntario', '!=', (int)$request->idsVoluntarios[$i])
                ->where('id_jornada', '=', $request->id_jornada)
                ->delete();
            }        
        }

        return response()->json([
            'isOk' => true,
            'message' => '¡La jornada fue actualizada exitosamente!'
        ]);
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

    public function getAllVoluntantiesByActive($id_institution){
        $voluntarios = DB::table('voluntarios')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
        ->where([['eliminado', '=', 0],
                ['voluntarios.activo', '=', 0],
                ['voluntarios.id_insti', '=', $id_institution]
          ])
        ->get();
        return response()->json([
            'data' => $voluntarios        
        ]); 
    }

    public function getJornada($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select(               
                'jornadas.id_jornada AS id_jornada',
                'jornadas.fecha_inicio AS fecha_inicio',
                'jornadas.fecha_fin AS fecha_fin',
                'jornadas.mensaje AS mensaje',
                'jornadas.activo AS jornada_activa',
                'detalle_jornadas.id_detalle_jornada AS id_detalle_jornada',
                'detalle_jornadas.activo AS voluntario_jornada_activo',
                'detalle_jornadas.id_voluntario AS id_voluntario',
                'voluntarios.id_insti AS id_insti',
                'voluntarios.nombre AS nombre',
                'voluntarios.ape_pat AS ape_pat',
                'voluntarios.ape_mat AS ape_mat',
                'voluntarios.tel AS tel',
                'voluntarios.email AS email',
                'instituciones.nombre AS nombre_institucion',
                'municipios.nombre AS nombre_municipio'
        )
        ->where('detalle_jornadas.id_jornada', '=', $id_jornada)
        ->get();
        return response()->json([
            'data' => $jornadas        
        ]); 
    }

    public function getJornadaDetail($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('detalle_jornadas.id_detalle_jornada AS id_detalle_jornada',
                'voluntarios.nombre AS nombre',
                'voluntarios.ape_pat AS ape_pat',
                'voluntarios.ape_mat AS ape_mat',
                'voluntarios.tel AS tel',
                'voluntarios.email AS email',
                'instituciones.nombre AS nombre_institucion',
                'municipios.nombre AS nombre_municipio'
        )
        ->where('jornadas.id_jornada', '=', $id_jornada)
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
        $institutions = DB::table('instituciones')->where('activo', '=', 1)->get();
        return response()->json([
            'data' => $institutions       
        ]); 
    }

    public function enviarCorreoJornada(Request $request){ 
        if(count($request->ids_detalle_jornadas) != 0){
            $detalle_jornada = DB::table('detalle_jornadas')->where('id_detalle_jornada', '=', (int)$request->ids_detalle_jornadas[0])->first();
            $jornada = DB::table('jornadas')->where('id_jornada', '=', $detalle_jornada->id_jornada)->first();
            for ($j = 0; $j < count($request->ids_detalle_jornadas); $j++) {
                $detalle_jornadas = DB::table('detalle_jornadas')->where('id_detalle_jornada', '=', (int)$request->ids_detalle_jornadas[$j])->first();
                $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detalle_jornadas->id_voluntario)->first();
                $data = [
                    'nombre' => $voluntario->nombre . ' ' . $voluntario->ape_pat . ' ' . $voluntario->ape_mat,
                    'id' => $voluntario->id_voluntario, 
                    'uuid' => $detalle_jornada->uuid,
                    'mensaje' => $jornada->mensaje,
                ];
                Mail::to($voluntario->email)->send(new ConfirmJornada($data));

                return response()->json([
                    'mensaje' => 'Correos enviados'
                ]); 
            }
        }

    }

    public static function rechazarJornada($uuid){
        $detallejornada = DB::table('detalle_jornadas')->where('uuid', '=', $uuid)->first();
        $jornada = DetalleJornada::findOrFail($detallejornada->id_detalle_jornada);
        $jornada->activo = false;
        $save = $jornada->save();
        $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
        if($save){
            return view('volunteers.rechazarJornada', compact('voluntario'));
        }
    }

    public static function aceptarJornada($uuid){
        $detallejornada = DB::table('detalle_jornadas')->where('uuid', '=', $uuid)->first();
        $jornada = DetalleJornada::findOrFail($detallejornada->id_detalle_jornada);
        $jornada->activo = true;
        $save = $jornada->save();
        $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
        if($save){
            return view('volunteers.aceptarjornada', compact('voluntario'));
        }
    }
}