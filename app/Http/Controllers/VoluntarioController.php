<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;
use App\Models\Municipio;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\DetalleJornada;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SaveVoluntario;

class VoluntarioController extends Controller
{

     /**
     * Método que redirecciona a la vista inicial pública para el registro de voluntarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        return view('index', compact('municipios', 'instituciones'), $data);
    }
    /**
     * Método que redirecciona a la vista de registro público de voluntarios, teniendo como carga inicial municipios e instituciones.
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
     * Método que redirecciona a la vista de registro público de voluntarios, teniendo como carga inicial municipios e instituciones.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('volunteers.registration', compact('municipios', 'instituciones'));
    }

    /**
     * Método que redireciona a la vista para el registro de voluntarios para administradores o enlaces. Teniendo como carga inicial instituciones y municipios
     *
     * @return \Illuminate\Http\Response
     */
    public function createAdmin()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
        $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('volunteers.create_voluntary', compact('municipios', 'instituciones'), $data);
    }

    /**
     * Método que almacena el resgistro de voluntarios. Si el registro se almaceno correctamente retorna "success" o "fail" en caso contrario
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
            'email' => 'required|email|unique:voluntarios|unique:usuarios', 
            'fecha_nacimiento' => 'required',
            'tel' => 'required',
        ]);

        $voluntario = new Voluntario;
        $voluntario->id_municipio = (int)$request->id_municipio;
        $voluntario->id_insti = (int)$request->id_insti;
        $voluntario->nombre = $request->nombre;
        $voluntario->ape_pat = $request->ape_pat;
        $voluntario->ape_mat = $request->ape_mat;
        $voluntario->curp = strtoupper($request->curp);
        $voluntario->fecha_nacimiento = $request->fecha_nacimiento;
        $voluntario->tel = $request->tel;
        $voluntario->email = $request->email;
        $voluntario->activo = false;
        $voluntario->eliminado = false;
        $voluntario->fecha_creacion = Carbon::now();
        $save = $voluntario->save();
        // if($voluntario != null){
        //     $data = [
        //         'nombre' => $voluntario->nombre . ' ' . $voluntario->ape_pat . ' ' . $voluntario->ape_mat,
        //         'id' => $voluntario->id_voluntario, 
        //     ];
        //     Mail::to($voluntario->email)->send(new SaveVoluntario($data));
        // }

        if($save){
            return redirect()->back()->with('success', '¡Tus datos fueron agregados correctamente, te enviamos un correo a tu email!');
        }else{
            return redirect()->back()->with('fail', 'tus datos no puedieron ser agregados correctamente');
        }
    }

    /**
     * Método que redirecciona a la vista donde se muestra la tabla de voluntarios activos.
     *
     * @param  \App\Models\Voluntario  $voluntario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $rol = session('LoggedUserNivel');
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        if($rol == 'Administrador General'){
            $voluntarios = DB::table('voluntarios')
            ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
            ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
            ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
            ->where('eliminado', '=', 0)
            ->get();
        }
        else{
            $id_user = session('LoggedUser');
            $id = $id = DB::table('usuarios')->where('id_user', '=', $id_user)->value('id_insti'); 
            $voluntarios = DB::table('voluntarios')
            ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
            ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
            ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
            ->where([[ 'voluntarios.id_insti', '=', $id], ['eliminado', '=', 0]])
            ->get();
        }
        return view('admin.voluntaries', compact('voluntarios'), $data);
    }

    /**
     * Método que redirrecciona la edición de voluntarios 
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
     * Método que permite la actualización de los datos de un voluntario, si se actualizo correctamente entonces retorna "success" o "fail" en caso contrario
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
            'fecha_nacimiento' => 'required',
            'email' => 'required',
        ]);
        $voluntarioEditado = Voluntario::findOrFail($id);
        $voluntarioEditado->id_municipio = (int)$request->id_municipio;
        $voluntarioEditado->id_insti = (int)$request->id_insti;
        $voluntarioEditado->nombre = $request->nombre;
        $voluntarioEditado->ape_pat = $request->ape_pat;
        $voluntarioEditado->ape_mat = $request->ape_mat;
        $voluntarioEditado->curp = strtoupper($request->curp);
        $voluntarioEditado->fecha_nacimiento = $request->fecha_nacimiento;
        $voluntarioEditado->tel = $request->tel;
        $voluntarioEditado->email = $request->email;
        $voluntarioEditado->activo = false;
        $voluntarioEditado->eliminado = false;
        $voluntarioEditado->fecha_edicion = Carbon::now();
        $save = $voluntarioEditado->save();
        if($save){
            return redirect()->back()->with('success', '¡Los datos del voluntarios fueron actualizados correctamente!');
        }else{
            return redirect()->back()->with('fail', 'Error al actualizar los datos del voluntario');
        }
    }

    /**
     * Método que permite el eliminado lógico de un voluntario cambiarndo el campo "eliminado" a true.
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
            'data' => $nameVoluntary        
        ]); 
    }

    public function searchByTown($id)
    {
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

    public function searchByCURP($id){    
        $nameVoluntary = DB::table('voluntarios')
        ->join('instituciones', 'voluntarios.id_insti', '=', 'instituciones.id_insti')
        ->join('municipios', 'voluntarios.id_municipio', '=', 'municipios.id_municipio')
        ->select('voluntarios.*', 'instituciones.nombre AS nombre_institucion', 'municipios.nombre AS nombre_municipio')
        ->where([
            ['eliminado', '=', 0],
            ['voluntarios.curp', '=', $id]
        ])
        ->get();
        return response()->json([
            'data' => $nameVoluntary         
        ]); 
    }

    public function searchByInstitution($id)
    {    
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

    public function searchByDates($fecha_inicio, $fecha_fin){
        $nameVoluntary = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
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
            'municipios.nombre AS nombre_municipio'
        )
        ->where('jornadas.fecha_inicio', '=', $fecha_inicio)
        ->where('jornadas.fecha_fin', '=', $fecha_fin)
        ->distinct()
        ->get();

        return response()->json([
            'data' => $nameVoluntary         
        ]); 
    }

    public function searchBySedes($id){
        $nameVoluntary = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
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
            'municipios.nombre AS nombre_municipio'
        )
        ->where('detalle_jornadas.id_sede', '=', $id)
        ->distinct()
        ->get();

        return response()->json([
            'data' => $nameVoluntary         
        ]); 
    }
    
    public function searchByHours($hours){
        $nameVoluntary = DB::table('detalle_jornadas')
        ->join('jornadas', 'detalle_jornadas.id_jornada', '=', 'jornadas.id_jornada')
        ->join('voluntarios', 'detalle_jornadas.id_voluntario', '=', 'voluntarios.id_voluntario')
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
            'municipios.nombre AS nombre_municipio'
        )
        ->where('detalle_jornadas.horas', '=', $hours)
        ->distinct()
        ->get();

        return response()->json([
            'data' => $nameVoluntary         
        ]);
    } 
    #endreion 

    public function getAllTowns()
    {  
        $towns = DB::table('municipios')->get();
        return response()->json([
            'data' => $towns          
        ]); 
    }

    public function getAllSedes(){
        $sedes = DB::table('sedes')->where('activo', '=', 1)->get();
        return response()->json([
            'data' => $sedes          
        ]); 
    }

    public function getAllInstitutions()
    {   
        $institutions = DB::table('instituciones')->where('activo', '=', 1)->get();
        return response()->json([
            'data' => $institutions       
        ]); 
    }

    public static function emailConfirmacion($id){
        $voluntario = Voluntario::findOrFail($id);

        $voluntario->activo = true;
        $voluntario->fecha_edicion = Carbon::now();
        $save = $voluntario->save();
        if($save){
            return view('volunteers.confirm');
        }
        
    }

    public static function confirmarJornada($uuid){
        $jornada = DetalleJornada::findOrFail($uuid);
        $jornada->activo = true;
        $save = $jornada->save();
        if($save){
            return view('email.confirmJornada');
        }
        
    }

    public function aviso()
    {
        return view('volunteers.aviso');
    }
}
