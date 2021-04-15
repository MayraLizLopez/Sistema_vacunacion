<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Voluntario;
use App\Models\Municipio;
use App\Models\Institucion;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SaveVoluntario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios =  DB::select('SELECT * FROM usuarios ORDER BY nombre ASC');
        return view('users.index', compact('usuarios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituciones =  DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
        return view('users.registration', compact('instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request)
        $this->validate($request, ['nombre' => 'required', 'ape_pat' => 'required', 'email' => 'required', 'tel' => 'required', 'password' => 'requered']);
        $emailUnico = DB::select('SELECT COUNT(*) FROM usuarios WHERE email = '.$request->input('email'));
        if($emailUnico == 0){
            DB::insert('insert into usuarios (nombre, ape_pat, ape_mat, id_insti, cargo, rol, tel, email, password, activo) values(?,?,?,?,?,?,?,?,?,?)', [$request->input('nombre'), $request->input('ape_pat'), $request->input('ape_mat'), (int)$request->input('id_insti'), $request->input('cargo'), $request->input('rol'), $request->input('tel'), $request->input('email'),  $request->input('password'), true]);
            $mensaje = "success";

            return redirect()->route('/');
        }else{
            $mensaje = "El email ya fue registrado";
            $municipios = DB::select('SELECT * FROM municipios ORDER BY nombre ASC');
            $instituciones = DB::select('SELECT * FROM instituciones ORDER BY nombre ASC');
            
            return view('voluntarios', compact('municipios', 'instituciones', 'mensaje'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data =  ['LoggedUserInfo'=>Usuario::where('id_user', '=', session('LoggedUser'))->first()]; 
        $id =  session('LoggedUser');
        $user = DB::table('usuarios')->where('id_user', $id)->first();
        $institucion = DB::table('instituciones')->where('id_insti', $user->id_insti)->first();
        
        return view('admin.Profile', compact('user', 'institucion'), $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function savePassword(Request $request)
    {
        $request->validate([
            'password' => 'required', 
        ]);
        
        $id =  session('LoggedUser');
        $user = Usuario::findOrFail($id);
        $user->password = Hash::make($request->password);
        $save = $user->save();     
        
        if($save){
            return redirect()->back()->with('success', '¡Tus datos fueron agregados correctamente, te enviamos un correo a tu email!');
        }else{
            return redirect()->back()->with('fail', 'tus datos no puedieron ser agregados correctamente');
        }
    }
}
