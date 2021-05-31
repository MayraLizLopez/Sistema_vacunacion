<?php

namespace App\Http\Controllers;

use App\Mail\CancelarJornada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Usuario;
use App\Models\Jornada;
use App\Models\DetalleJornada;
use App\Models\Voluntario;

use App\Mail\ConfirmJornada;
use App\Models\AnexoJornada;

use Illuminate\Support\Facades\Mail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

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
        $jornada->fecha_inicio = $request->fecha_inicio;
        $jornada->fecha_fin = $request->fecha_fin;
        $jornada->mensaje = $request->mensaje;
        $jornada->activo = true;
        $jornada->fecha_creacion = Carbon::now();
        $save1 = $jornada->save();

        DB::table('jornadas')
        ->where('id_jornada', $jornada->id_jornada)
        ->update([
            'folio' => 'F000' . $jornada->id_jornada
        ]);

        foreach(json_decode($request->idSedes) as $id_sede){
            foreach(json_decode($request->idsVoluntarios) as $id_voluntario){
                $detalle_jornada = new DetalleJornada;
                $detalle_jornada->id_jornada = $jornada->id_jornada;
                $detalle_jornada->id_voluntario = (int)$id_voluntario;
                $detalle_jornada->uuid = DB::raw('UUID()');
                $detalle_jornada->id_sede = (int)$id_sede;
                $detalle_jornada->horas = 0;
                $detalle_jornada->correo_enviado = false;
                $detalle_jornada->eliminado = false;
                $save2 = $detalle_jornada->save();
            }
        }

        if($save1 && $save2){
            return response()->json([
                'id_jornada' => $jornada->id_jornada,
                'isOk' => true,
                'message' => '¡La jornada fue guardada exitosamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => true,
                'message' => 'Error al registrar la jornada'       
            ]); 
        }
    }

    public function storeFiles(Request $request){
        $nombre_archivo = $request->file->getClientOriginalName();
        $tipo_archivo = $request->file->getMimeType();
        $data_archivo = file_get_contents($request->file->getRealPath());

        foreach(json_decode($request->idsVoluntarios) as $id_voluntario){

            $anexo_jornada = new AnexoJornada;
            $anexo_jornada->id_jornada = $request->id_jornada;
            $anexo_jornada->id_voluntario = (int)$id_voluntario;
            $anexo_jornada->nombre = $nombre_archivo;
            $anexo_jornada->anexo = base64_encode($data_archivo);
            $anexo_jornada->tipo = $tipo_archivo;
            $save = $anexo_jornada->save();
        }

        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡Los anexos fueron guardados exitosamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => true,
                'message' => 'Error al intentar guardar los anexos'       
            ]); 
        }
    }

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

        foreach(json_decode($request->idSedes) as $id_sede){
            foreach(json_decode($request->idsVoluntarios) as $id_voluntario){
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
                'id_jornada' => $request->id_jornada,
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

    public function updateFiles(Request $request){
        DB::table('anexo_jornadas')
        ->where('id_jornada', '=', $request->id_jornada)
        ->delete();
        
        $nombre_archivo = $request->file->getClientOriginalName();
        $tipo_archivo = $request->file->getMimeType();
        $data_archivo = file_get_contents($request->file->getRealPath());

        foreach(json_decode($request->idsVoluntarios) as $id_voluntario){
            $jornada = DB::table('jornadas')->latest('id_jornada')->first();

            $anexo_jornada = new AnexoJornada;
            $anexo_jornada->id_jornada = $jornada->id_jornada;
            $anexo_jornada->id_voluntario = (int)$id_voluntario;
            $anexo_jornada->nombre = $nombre_archivo;
            $anexo_jornada->anexo = base64_encode($data_archivo);
            $anexo_jornada->tipo = $tipo_archivo;
            $save = $anexo_jornada->save();
        }

        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡Los anexos fueron guardados exitosamente! ' . $nombre_archivo
            ]); 
        }else{
            return response()->json([
                'isOk' => true,
                'message' => 'Error al intentar guardar los anexos'       
            ]); 
        }
    }

    public function downloadFiles(){
        $file = DB::table('anexo_jornadas')->latest('id_anexo_jornadas')->first();
        $file_contents = base64_decode($file->anexo);

        return response($file_contents)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $file->tipo)
        ->header('Content-length', strlen($file_contents))
        ->header('Content-Disposition', 'attachment; filename=' . $file->nombre)
        ->header('Content-Transfer-Encoding', 'binary');
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
            'jornadas.folio AS folio',
            'jornadas.fecha_inicio AS fecha_inicio',
            'jornadas.fecha_fin AS fecha_fin' ,
            'municipios.id_municipio AS id_municipio',
            'municipios.nombre AS nombre_municipio',    
            DB::raw('COUNT(DISTINCT detalle_jornadas.id_voluntario) as total_voluntarios'),
            DB::raw("group_concat(DISTINCT sedes.nombre SEPARATOR ', ') as nombres_sedes"))
        ->where('jornadas.activo', '=', true)
        ->orderByDesc('jornadas.fecha_creacion')
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
        $voluntarios = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->rightJoin('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select(
            'voluntarios.id_voluntario AS id_voluntario',              
            'voluntarios.nombre AS nombre',
            'voluntarios.ape_pat AS ape_pat',
            'voluntarios.ape_mat AS ape_mat',
            'voluntarios.email AS email',
            'voluntarios.tel AS tel',
            'voluntarios.curp AS curp',
            'instituciones.nombre AS nombre_institucion',
            'municipios.nombre AS nombre_municipio',
            DB::raw('SUM(detalle_jornadas.horas) AS horas')
        )
        ->where('voluntarios.eliminado', '=', 0)
        ->whereIn('voluntarios.id_insti', $request->ids_institution)
        ->groupBy('voluntarios.id_voluntario')
        ->distinct()
        ->get();
        
        
        // $voluntarios = DB::table('voluntarios')
        // ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        // ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        // ->select(
        //     'voluntarios.*',
        //     'instituciones.id_municipio AS id_instituciones_municipio',
        //     'instituciones.nombre AS nombre_institucion',
        //     'municipios.nombre AS nombre_municipio'
        //  )
        // ->where([['eliminado', '=', 0],
        //         ['voluntarios.activo', '=', 0]])
        // ->whereIn('voluntarios.id_insti', $request->ids_institution)
        // ->get();


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

    public function getFilesJornada($id_jornada){
        $files = DB::table('anexo_jornadas')
        ->select( 'nombre')
        ->where('id_jornada', '=', $id_jornada)
        ->distinct()
        ->get();

        return response()->json([
            'data' => $files        
        ]); 
    }

    public function getJornadaForVoluntaries($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select(              
            'voluntarios.id_voluntario as id_voluntario',
            'voluntarios.nombre AS nombre',
            'voluntarios.ape_pat AS ape_pat',
            'voluntarios.ape_mat AS ape_mat',
            'voluntarios.tel AS tel',
            'voluntarios.email AS email',
            'instituciones.nombre AS nombre_institucion',
            'municipios.nombre AS nombre_municipio',
            DB::raw('SUM(detalle_jornadas.horas) AS horas')
        )
        ->where('detalle_jornadas.id_jornada', '=', $id_jornada)
        ->groupBy('voluntarios.id_voluntario')
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

    public function getAllVolunteersAccepted($folio){
        $voluntarios = DB::table('detalle_jornadas')
        ->select(
            'detalle_jornadas.id_jornada AS id_jornada',
            'detalle_jornadas.id_detalle_jornada AS id_detalle_jornada',
            'jornadas.folio AS folio',
            'voluntarios.id_voluntario AS id_voluntario',
            'voluntarios.nombre AS nombre',
            'voluntarios.ape_pat AS ape_pat',
            'voluntarios.ape_mat AS ape_mat',
            'voluntarios.tel AS tel',
            'voluntarios.email AS email',
            'voluntarios.curp AS curp',
            'instituciones.nombre AS nombre_institucion',
            'municipios.nombre AS nombre_municipio',
            'detalle_jornadas.turno AS turno',
            'detalle_jornadas.horas AS horas'
        )
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->where('detalle_jornadas.activo', '=', 1)
        ->where('jornadas.folio', '=', $folio)
        ->get();

        return response()->json([
            'data' => $voluntarios      
        ]);
    }

    public function getJornadaDetailForEmails($id_jornada){
        $jornadas = DB::table('detalle_jornadas')
        ->select(
            'id_voluntario',
            'id_detalle_jornada'
        )
        ->where('id_jornada', $id_jornada)
        ->where('correo_enviado', 0)
        ->get();
    
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

    public function agregarQuitarHoras(Request $request){
        $horasAteriores = DB::table('detalle_jornadas')->select('id_detalle_jornada','horas')->whereIn('id_detalle_jornada', $request->ids_detalle_jornadas)->get();

        foreach($horasAteriores AS $horaAnterior){
            $horas = ($horaAnterior->horas + $request->horas);
            DB::table('detalle_jornadas')
            ->where('id_detalle_jornada', $horaAnterior->id_detalle_jornada)
            ->update([
                'horas' => $horas
            ]);
        }

        return response()->json([
            'mensaje' => 'Las horas han sido guardadas'
        ]); 
    }
    /**
     * Método que permite el envio de correos en la vista de jornadas al hacer click sobre el botón "Enviar Correos". El correo enviado es personalizado para cada voluntario
     * permitiendo elegir entre las sedes que de la joranada que fue convocado, así como la opción de rechazar su participación en la jornada. En base de datos cambiara el 
     * campo "correo_enviado" de la tabla detalle_jornadas, por true(1) si él correo fue enviado correctamente.
     */
    public function enviarCorreoJornada(Request $request){ 
        if(count($request->ids_detalle_jornadas) != 0){  
            $detalle_jornada = DB::table('detalle_jornadas')->where('id_detalle_jornada', '=', (int)$request->ids_detalle_jornadas[0])->first();
            $jornada = DB::table('jornadas')->where('id_jornada', '=', $detalle_jornada->id_jornada)->first();
            $anexos = DB::table('anexo_jornadas')->select('nombre', 'anexo', 'tipo')->where('id_jornada', '=', $detalle_jornada->id_jornada)->distinct()->get();

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
                $fecha = $jornada->fecha_inicio;
                $year = substr($fecha, 0, 4);
                $mes = substr($fecha, 5, 2);
                $dia = substr($fecha, 8, 2);

                switch ($mes) {
                    case '01':
                        $fecha_inicio = $dia.'/enero/'.$year;
                        break;
                    case '02':
                        $fecha_inicio = $dia.'/febrero/'.$year;
                        break;
                    case '03':
                        $fecha_inicio = $dia.'/marzo/'.$year;
                        break;
                    case '04':
                        $fecha_inicio = $dia.'/abril/'.$year;
                        break;
                    case '05':
                        $fecha_inicio = $dia.'/mayo/'.$year;
                        break;
                    case '06':
                        $fecha_inicio = $dia.'/junio/'.$year;
                        break;
                    case '07':
                        $fecha_inicio = $dia.'/julio/'.$year;
                        break;
                    case '08':
                        $fecha_inicio = $dia.'/agosto/'.$year;
                        break;
                    case '09':
                        $fecha_inicio = $dia.'/septiembre/'.$year;
                        break;
                    case '10':
                        $fecha_inicio = $dia.'/octubre/'.$year;
                        break;
                    case '11':
                        $fecha_inicio = $dia.'/noviembre/'.$year;
                        break;
                    case '12':
                        $fecha_inicio = $dia.'/diciembre/'.$year;
                        break;
                }

                $fecha = $jornada->fecha_fin;
                $year = substr($fecha, 0, 4);
                $mes = substr($fecha, 5, 2);
                $dia = substr($fecha, 8, 2);

                switch ($mes) {
                    case '01':
                        $fecha_fin = $dia.'/enero/'.$year;
                        break;
                    case '02':
                        $fecha_fin = $dia.'/febrero/'.$year;
                        break;
                    case '03':
                        $fecha_fin = $dia.'/marzo/'.$year;
                        break;
                    case '04':
                        $fecha_fin = $dia.'/abril/'.$year;
                        break;
                    case '05':
                        $fecha_fin = $dia.'/mayo/'.$year;
                        break;
                    case '06':
                        $fecha_fin = $dia.'/junio/'.$year;
                        break;
                    case '07':
                        $fecha_fin = $dia.'/julio/'.$year;
                        break;
                    case '08':
                        $fecha_fin = $dia.'/agosto/'.$year;
                        break;
                    case '09':
                        $fecha_fin = $dia.'/septiembre/'.$year;
                        break;
                    case '10':
                        $fecha_fin = $dia.'/octubre/'.$year;
                        break;
                    case '11':
                        $fecha_fin = $dia.'/noviembre/'.$year;
                        break;
                    case '12':
                        $fecha_fin = $dia.'/diciembre/'.$year;
                        break;
                }

                $data = [
                    'uuid' => $detalle_jornadas->uuid,
                    'nombre' => $voluntario->nombre . ' ' . $voluntario->ape_pat . ' ' . $voluntario->ape_mat,
                    'id_voluntario' => $voluntario->id_voluntario, 
                    'id_jornada' => $detalle_jornadas->id_jornada,
                    'fecha_inicio' => $fecha_inicio,
                    'fecha_fin' => $fecha_fin,
                    'mensaje' => $jornada->mensaje,
                    'sedes' => $sedes,
                    'anexos' => $anexos,
                ];
                
                //Mail::to($voluntario->email)->send(new ConfirmJornada($data));
                Limit::perMinute(50)->by(Mail::to($voluntario->email)->send(new ConfirmJornada($data)));
                 
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

    public function enviarCorreoCancelacionJornada(Request $request){ 
        $jornada = DB::table('jornadas')->where('id_jornada', '=', $request->id_jornada)->first();

        for ($j = 0; $j < count($request->ids_detalle_jornada); $j++) {
            $detalle_jornadas = DB::table('detalle_jornadas')->where('id_detalle_jornada', '=', (int)$request->ids_detalle_jornada[$j])->first();
            $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detalle_jornadas->id_voluntario)->first();

            $data = [
                'nombre' => $voluntario->nombre . ' ' . $voluntario->ape_pat . ' ' . $voluntario->ape_mat,
                'fecha_inicio' => $jornada->fecha_inicio,
                'fecha_fin' => $jornada->fecha_fin,
                'mensaje' => $request->mensaje
            ];
            
            Mail::to($voluntario->email)->send(new CancelarJornada($data));
            
        }

        return response()->json([
            'mensaje' => 'Correos enviados',
        ]); 
    }

    /**
     * Método que permite al voluntario rechazar la jornada cambiado el estatus del campo activo de la tabla detalle_jornadas, por false(0) indicando que se rechazo la jornada.
     */
    public static function rechazarJornada($uuid){
        $detallejornada = DB::table('detalle_jornadas')->where('uuid', '=', $uuid)->first();
        if($detallejornada == null){
            return view('volunteers.paginaError');
        }
        if($detallejornada->horas == 0){
            $detalles = DB::table('detalle_jornadas')->where('id_jornada', '=', $detallejornada->id_jornada)->where('id_voluntario', '=', $detallejornada->id_voluntario)->get();
            for ($i=0; $i<count($detalles); $i++){
                $jornada = DetalleJornada::findOrFail($detalles[$i]->id_detalle_jornada);
                $jornada->activo = false;
                $jornada->turno = null;
                $save = $jornada->save();   
            }
            $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
            $activo = DB::table('detalle_jornadas')->where('id_voluntario', '=', $detallejornada->id_voluntario)->where('activo', '=', 1)->first();
            if($activo == null){
                $volu = Voluntario::findOrFail($detallejornada->id_voluntario);
                $volu->activo = false;
                $volu->save();
            }
            if($save){
                return view('volunteers.rechazarJornada', compact('voluntario'));
            }
        }else{
            $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
            $sede = DB::table('sedes')->where('id_sede', '=', $detallejornada->id_sede)->first();
            $mensaje_jornada = Jornada::findOrFail($detallejornada->id_jornada);
            $turno = $detallejornada->turno;
            return view('volunteers.jornadaAceptada', compact('voluntario', 'mensaje_jornada', 'sede', 'uuid', 'turno'));
        }
        
    }

    /**
     * Método que permite al voluntario aceptar la jornada cambiado el estatus del campo activo de la tabla detalle_jornadas, por true(1) para la sede seleccionada 
     * y false(0) para el resto de las sedes.
     */
    public static function aceptarJornada($uuid){
        $detallejornada = DB::table('detalle_jornadas')->where('uuid', '=', $uuid)->first();
        if($detallejornada == null){
            return view('volunteers.paginaError');
        }
        if($detallejornada->horas == 0){
            if($detallejornada->activo == null){
                $detalles = DB::table('detalle_jornadas')->where('id_jornada', '=', $detallejornada->id_jornada)->where('id_voluntario', '=', $detallejornada->id_voluntario)->get();
                for ($i=0; $i<count($detalles); $i++){
                    $jornada = DetalleJornada::findOrFail($detalles[$i]->id_detalle_jornada);
                    $jornada->activo = false;
                    $jornada->turno = null;
                    $save = $jornada->save();   
                }
                $jornada = DetalleJornada::findOrFail($detallejornada->id_detalle_jornada);
                $jornada->activo = true;
                $save = $jornada->save();
                $mensaje_jornada = Jornada::findOrFail($detallejornada->id_jornada);
                $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
                $voluntarioActivo = Voluntario::findOrFail($detallejornada->id_voluntario);
                $voluntarioActivo->activo = true;
                $voluntarioActivo->save();
                $sede = DB::table('sedes')->where('id_sede', '=', $detallejornada->id_sede)->first();
                if($save){
                    return view('volunteers.aceptarjornada', compact('voluntario', 'mensaje_jornada', 'sede', 'uuid'));
                }
            }else{
                $mensaje_jornada = Jornada::findOrFail($detallejornada->id_jornada);
                $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
                $sede = DB::table('sedes')->where('id_sede', '=', $detallejornada->id_sede)->first();
                if($detallejornada->turno == null){
                    return view('volunteers.aceptarjornada', compact('voluntario', 'mensaje_jornada', 'sede', 'uuid'));
                }else{
                    $turno = $detallejornada->turno;
                    return view('volunteers.jornadaAceptada', compact('voluntario', 'mensaje_jornada', 'sede', 'uuid', 'turno'));
                }
                
            }
        }else{
            $voluntario = DB::table('voluntarios')->where('id_voluntario', '=', $detallejornada->id_voluntario)->first();
            $sede = DB::table('sedes')->where('id_sede', '=', $detallejornada->id_sede)->first();
            $mensaje_jornada = Jornada::findOrFail($detallejornada->id_jornada);
            $turno = $detallejornada->turno;
            return view('volunteers.jornadaAceptada', compact('voluntario', 'mensaje_jornada', 'sede', 'uuid', 'turno'));
        }
    }

    /**
     * Método que permite al voluntario seleccionar el turno de su preferencia para la jornada.
     */
    public static function guardarTurno($uuid, $turno){
        $detalle = DB::table('detalle_jornadas')->where('uuid', '=', $uuid)->first();
        $detallejornada = DetalleJornada::findOrFail($detalle->id_detalle_jornada);
        $detallejornada->turno = $turno;
        $save = $detallejornada->save();
        if($save){
            return response()->json([
                'isOk' => true,
                'message' => '¡Elegiste el turno '.$turno.', este se guardo exitosamente!'
            ]); 
        }else{
            return response()->json([
                'isOk' => true,
                'message' => 'Error al intentar guardar el turno'       
            ]); 
        }
    }
}