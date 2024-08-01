<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HaveToLogInResponsable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!session()->has('responsable_id')){
            session()->flash('middleware_responsable', "Connectez-vous d'abord");
            return redirect('/connexion/responsable');
        }else{
            return $next($request);
        }
    }
}
