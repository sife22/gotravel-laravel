<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HaveToLogInAgence
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!session()->has('agence_id')){
            session()->flash('middleware_agence', "Connectez-vous d'abord");
            return redirect('/connexion/agence');
        }else{
            return $next($request);
        }
    }
}
