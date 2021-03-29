<?php

namespace App\Http\Controllers;

use App\Models\Voluntario;
use Illuminate\Http\Request;
use DB;
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
        $municipios = Municipio::orderBy('nombre', 'ASC');
        $instituciones = Institucion::orderBy('nombre', 'ASC');
        dd($municipios);
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
        $municipios = Municipio::orderBy('nombre', 'ASC');
        $instituciones = Institucion::orderBy('nombre', 'ASC');
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
        $this->validate($request, ['nombre' => 'required', 'ape_pat' => 'required', 'email' => 'required', 'tel' => 'required']);
        Voluntario::create($request->all(), 'activo');
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
