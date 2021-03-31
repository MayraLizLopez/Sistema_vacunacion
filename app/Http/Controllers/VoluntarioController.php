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
        $voluntarioEdit = DB::table('voluntarios')->where('id_voluntario', $voluntario->id_voluntario)->get();
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return back()->with('editar', 'edicion de voluntario', compact('voluntarioEdit', 'municipios', 'instituciones'));
        //return view('admin/panel/show', compact('voluntarioEdit', 'municipios', 'instituciones'));
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
        $request->validate([
            'nombre' => 'required', 
            'ape_pat' => 'required',
            'id_municipio' => 'required',
            'id_insti' => 'required', 
            'email' => 'required|email|unique:voluntarios', 
            'tel' => 'required',
        ]);

        $voluntarioEditado = Usuario::findOrFail($voluntario->id_volunario);
        $voluntarioEditado->nombre = $voluntario->nombre;
        $voluntarioEditado->ape_pat = $voluntario->ape_pat;
        $voluntarioEditado->ape_mat = $voluntario->ape_mat;
        $voluntarioEditado->id_municipio = (int)$voluntario->id_municipio;
        $voluntarioEditado->id_insti = (int)$voluntario->id_insti;
        $voluntarioEditado->tel = $voluntario->tel;
        $voluntarioEditado->email = $voluntario->email;
        $voluntarioEditado->activo = false;
        $voluntarioEditado->eliminado = false;
        $save = $voluntario->save();
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
    public function destroy(Voluntario $voluntario)
    {
        //
        $voluntario->eliminado = true;
        $save = $voluntario->save();
        if($save){
            return back()->with('success', '¡El volutario fue eliminado correctamente!');
        }else{
            return back()->with('fail', 'Error al eliminar al voluntario');
        }
    }
}
