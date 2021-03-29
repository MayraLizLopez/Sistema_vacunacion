<?php

namespace App\Http\Controllers;

use App\Models\Voluntario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;
use App\Models\Institucion;

class VoluntarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones =  DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        //dd($municipios);
        return view('volunteers.registration', compact('municipios', 'instituciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('voluntarios', compact('municipios', 'instituciones'));

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
        $this->validate($request, ['nombre' => 'required', 'ape_pat' => 'required', 'email' => 'required|unique', 'tel' => 'required']);
        DB::insert('insert into voluntarios (nombre, ape_pat, ape_mat, id_insti, id_municipio, tel, email, activo)', [$request->input('nombre'), $request->input('ape_pat'), $request->input('ape_mat'), $request->input('id_insti'), $request->input('id_municipio'), $request->input('tel'), $request->input('email'), true]);
        $mensaje = "success";
        return redirect()->route('');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function show(Voluntario $voluntario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function edit(Voluntario $voluntario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voluntario $voluntario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voluntario $voluntario)
    {
        //
    }
}
