<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;
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
        //$voluntarios = DB::select('SELECT * FROM voluntarios ORDER BY nombre ASC');
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('volunteers.registration', compact('municipios', 'instituciones'));
        //return view('volunteers.registration', compact('voluntarios'));
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
        return view('volunteers.registration', compact('municipios', 'instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input('nombre'), $request->input('ape_pat'), $request->input('ape_mat'), (int)$request->input('id_insti'), (int)$request->input('id_municipio'), $request->input('tel'), $request->input('email'));
        $this->validate($request, ['nombre' => 'required', 'ape_pat' => 'required', 'email' => 'required', 'tel' => 'required']);
        //$emailUnico = DB::select('SELECT COUNT(*) FROM voluntarios WHERE email = '.$request->input('email'));
        // if($emailUnico == 0){
        //     DB::insert('insert into voluntarios (nombre, ape_pat, ape_mat, id_insti, id_municipio, tel, email, activo) values(?,?,?,?,?,?,?,?)', [$request->input('nombre'), $request->input('ape_pat'), $request->input('ape_mat'), (int)$request->input('id_insti'), (int)$request->input('id_municipio'), $request->input('tel'), $request->input('email'), true]);
        //     $mensaje = "success";

        //     return view('index');
        // }else{
        //     $mensaje = "El email ya fue registrado";
        //     $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        //     $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');

        //     return view('voluntario', compact('municipios', 'instituciones', 'mensaje'));
        // }
        DB::insert('insert into voluntarios (nombre, ape_pat, ape_mat, id_insti, id_municipio, tel, email, activo) values(?,?,?,?,?,?,?,?)', [$request->input('nombre'), $request->input('ape_pat'), $request->input('ape_mat'), (int)$request->input('id_insti'), (int)$request->input('id_municipio'), $request->input('tel'), $request->input('email'), true]);
        return view('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $voluntarios = DB::select('SELECT * FROM voluntarios ORDER BY nombre ASC');   
        return view('admin.voluntaries', compact('voluntarios'));
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
