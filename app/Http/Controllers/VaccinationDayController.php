<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Usuario;
use App\Models\Jornada;
use App\Models\DetalleJornada;

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
            'id_insti' => 'required',
            'mensaje' => 'required',
            'detalleJornada' => 'required'
        ]);
            $jornada = new Jornada;
            $jornada->fecha_inicio = $request->fecha_inicio;
            $jornada->fecha_fin = $request->fecha_fin;
            $jornada->mensaje = $request->mensaje;
            $jornada->activo = true;
            $jornada->fecha_creacion = Carbon::now();
            $save = $jornada->save();
            
            foreach($request->detalleJornada as $data){
                $detalle_jornada = new DetalleJornada;
                $detalle_jornada->id_jornada = $jornada->id_jornada;
                $detalle_jornada->id_insti = $request->detalleJornada[$data]->id_insti;
                $detalle_jornada->id_voluntario = $request->detalleJornada[$data]->id_voluntario;
                $detalle_jornada->uuid = Uuid::generate()->string;   
                $save1 = $detalle_jornada->save();
            }

            if($save && $save1){
                return back()->with('success', '¡La institución y el enlace fue registrados correctamente!');
            }else{
                return back()->with('fail', 'Error al registrar la institución y/o al enlace');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    public function getAllInstitutions()
    {  
        $institutions = DB::table('instituciones')->where('activo', '=', 1)->get();
        return response()->json([
            'data' => $institutions       
        ]); 
    }
}
