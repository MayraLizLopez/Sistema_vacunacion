<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
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
        return $next($request);
    }
}
