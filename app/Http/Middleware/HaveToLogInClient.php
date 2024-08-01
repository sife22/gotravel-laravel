<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HaveToLogInClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('client_id')) {
            session()->flash('middleware_client', "Connectez-vous d'abord");
            $request->session()->put('url',url()->previous());
            return redirect('/connexion/client');
        } else {
            return $next($request);
        }
    }
}
