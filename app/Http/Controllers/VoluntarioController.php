<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;
use App\Models\Municipio;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class VoluntarioController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('index', compact('municipios', 'instituciones'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
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
        $request->validate([
            'nombre' => 'required', 
            'ape_pat' => 'required',
            'id_municipio' => 'required',
            'id_insti' => 'required', 
            'email' => 'required|email|unique:voluntarios', 
            'tel' => 'required',
        ]);

        $voluntario = new Voluntario;
        $voluntario->nombre = $request->nombre;
        $voluntario->ape_pat = $request->ape_pat;
        $voluntario->ape_mat = $request->ape_mat;
        $voluntario->id_municipio = (int)$request->id_municipio;
        $voluntario->id_insti = (int)$request->id_insti;
        $voluntario->tel = $request->tel;
        $voluntario->email = $request->email;
        $voluntario->activo = false;
        $voluntario->eliminado = false;
        $save = $voluntario->save();

        if($save){
            return back()->with('success', '¡Tus datos fueron agregados correctamente!');
        }else{
            return back()->with('fail', 'tus datos no puedieron ser agregados correctamente');
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
        $voluntarios = DB::table('voluntarios')->get();
        $instituciones = DB::table('instituciones')->get();   
        $municipios = DB::table('municipios')->get(); 
        return view('admin.voluntaries', compact('voluntarios', 'municipios', 'instituciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voluntarioEdit = DB::table('voluntarios')->where('id_voluntario', $id)->first();

        $municipios = DB::table('municipios')->get();   
        $muni = DB::table('municipios')->where('id_municipio', $voluntarioEdit->id_municipio)->first();
        $municipio_select = $muni->nombre;

        $instituciones = DB::table('instituciones')->get();   
        $insti = DB::table('instituciones')->where('id_insti', $voluntarioEdit->id_insti)->first();
        $institucion_select = $insti->nombre;

        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('volunteers.editVoluntary', compact('voluntarioEdit', 'municipios', 'municipio_select', 'instituciones', 'institucion_select'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required', 
            'ape_pat' => 'required',
            'id_municipio' => 'required',
            'id_insti' => 'required',
            'tel' => 'required', 
            'email' => 'required',
        ]);
        $voluntarioEditado = Voluntario::findOrFail($id);
        $voluntarioEditado->nombre = $request->nombre;
        $voluntarioEditado->ape_pat = $request->ape_pat;
        $voluntarioEditado->ape_mat = $request->ape_mat;
        $voluntarioEditado->id_municipio = (int)$request->id_municipio;
        $voluntarioEditado->id_insti = (int)$request->id_insti;
        $voluntarioEditado->tel = $request->tel;
        $voluntarioEditado->email = $request->email;
        $voluntarioEditado->activo = false;
        $voluntarioEditado->eliminado = false;
        $save = $voluntarioEditado->save();
        if($save){
            return back()->with('success', '¡Los datos del voluntarios fueron actualizados correctamente!');
        }else{
            return back()->with('fail', 'Error al actualizar los datos del voluntario');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voluntarioEliminar = Voluntario::findOrFail($id);
        $voluntarioEliminar->eliminado = true;
        $save = $voluntarioEliminar->save();
        if($save){
            return back()->with('success', '¡El volutario fue eliminado correctamente!');
        }else{
            return back()->with('fail', 'Error al eliminar al voluntario');
        }
    }
}
