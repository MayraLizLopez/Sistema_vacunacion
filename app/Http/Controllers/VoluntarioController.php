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
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        return view('index', compact('municipios', 'instituciones'), $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()];    
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('volunteers.registration', compact('municipios', 'instituciones'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('volunteers.registration', compact('municipios', 'instituciones'), $data);
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
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $voluntarios = DB::table('voluntarios')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
        ->where('eliminado', '=', 0)
        ->get();
        return view('admin.voluntaries', compact('voluntarios'), $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $voluntarioEdit = DB::table('voluntarios')->where('id_voluntario', $id)->first();

        $municipios = DB::table('municipios')->get();   
        $muni = DB::table('municipios')->where('id_municipio', $voluntarioEdit->id_municipio)->first();
        $municipio_select = $muni->nombre;

        $instituciones = DB::table('instituciones')->get();   
        $insti = DB::table('instituciones')->where('id_insti', $voluntarioEdit->id_insti)->first();
        $institucion_select = $insti->nombre;

        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('volunteers.editVoluntary', compact('voluntarioEdit', 'municipios', 'municipio_select', 'instituciones', 'institucion_select'), $data);
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
            return response()->json([
                'isOk' => true,
                'message' => '¡El volutario fue eliminado correctamente!'
            ]);          
        }else{
            return response()->json([
                'isOk' => false,
                'message'=> 'Error al eliminar al voluntario'
            ]);  
        }
    }

    #region Filtros
    public function searchByVoluntaryName($name)
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()];    
        $nameVoluntary = DB::table('voluntarios')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
        ->where([
            ['eliminado', '=', 0],
            ['voluntarios.nombre', '=', $name]
        ])
        ->get();
        return response()->json([
            'data' => $nameVoluntary,
            'session' => $data          
        ]); 
    }

    public function searchByTown($id)
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()];    
        $nameVoluntary = DB::table('voluntarios')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
        ->where([
            ['eliminado', '=', 0],
            ['voluntarios.id_municipio', '=', $id]
        ])
        ->get();
        return response()->json([
            'data' => $nameVoluntary         
        ]); 
    }

    public function searchByInstitution($id)
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()];    
        $nameVoluntary = DB::table('voluntarios')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
        ->where([
            ['eliminado', '=', 0],
            ['voluntarios.id_insti', '=', $id]
        ])
        ->get();
        return response()->json([
            'data' => $nameVoluntary         
        ]); 
    }

    public function getAllTowns()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()];    
        $towns = DB::table('municipios')->get();
        return response()->json([
            'data' => $towns          
        ]); 
    }

    public function getAllInstitutions()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()];    
        $institutions = DB::table('instituciones')->where('activo', '=', 1)->get();
        return response()->json([
            'data' => $institutions       
        ]); 
    }
    #endregion
}
