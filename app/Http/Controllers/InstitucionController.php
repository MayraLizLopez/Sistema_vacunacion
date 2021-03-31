<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;
use Illuminate\Support\Facades\Hash;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $instituciones = DB::table('instituciones')->get();   
        $municipios = DB::table('municipios')->get();   
        return view('admin.institutions', compact('instituciones', 'municipios'));
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
        $institucion = DB::table('instituciones')->where('id_insti', $id)->first();   
        $municipios = DB::table('municipios')->get();   
        $muni = DB::table('municipios')->where('id_municipio', $institucion->id_municipio)->first();   
        $municipio_select = $muni->nombre;
        return view('admin.edit_institutions', compact('institucion', 'municipios', 'municipio_select'));
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
    public function destroy(Institucion $institucion)
    {
        //
    }
}
