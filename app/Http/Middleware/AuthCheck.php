<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Método que permite el accesos a vista dependiendo el rol de usuarios y si los registros para el login son correctos o incorrectos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedUser') && ($request->path() != 'security/login')){
            return redirect('security/login')->with('fail', 'Necestitas iniciar sesión');
        }

        if(session()->has('LoggedUser') && ($request->path() == 'security/login')){
            return back();
        }
        //acceso a instituciones
        if(session('LoggedUserNivel') == 'Enlace de institución' && $request->path() == 'admin/panel/institutions'){
            return redirect('admin/panel/index')->with('fail', 'Necestitas iniciar sesión');
        }

        if(session('LoggedUserNivel') == 'Enlace de institución' && $request->path() == 'admin/panel/institutions/create'){
            return redirect('admin/panel/index')->with('fail', 'Necestitas iniciar sesión');
        }
         //acceso a jornadas
        if(session('LoggedUserNivel') == 'Enlace de institución' && $request->path() == 'admin/panel/vaccinationDay'){
            return redirect('admin/panel/index')->with('fail', 'Necestitas iniciar sesión');
        }
        //acceso a sedes
        if(session('LoggedUserNivel') == 'Enlace de institución' && $request->path() == 'admin/panel/sedes/index'){
            return redirect('admin/panel/index')->with('fail', 'Necestitas iniciar sesión');
        }

        if(session('LoggedUserNivel') == 'Enlace de institución' && $request->path() == 'admin/panel/sedes/crear'){
            return redirect('admin/panel/index')->with('fail', 'Necestitas iniciar sesión');
        }

        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma', 'no-cache')
                              ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GTM');
    }
}
