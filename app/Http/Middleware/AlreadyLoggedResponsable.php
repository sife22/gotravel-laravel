<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlreadyLoggedResponsable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(
            session()->has('responsable_id') 
            && ($request->url() == url('connexion') 
            || $request->url() == url('connexion/agence')
            || $request->url() == url('connexion/client') 
            || $request->url() == url('inscription/client')
            || $request->url() == url('inscription/agence')
            || $request->url() == url('connexion/admin')
            || $request->url() == url('connexion/responsable')
            || $request->url() === url('/'))
            )
            {
                return redirect('/accueil-responsable');
            }else{
                return $next($request);
            }
    }
}
