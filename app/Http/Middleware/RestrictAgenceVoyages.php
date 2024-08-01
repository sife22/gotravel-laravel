<?php

namespace App\Http\Middleware;

use App\Models\Voyage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAgenceVoyages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $voyageId = $request->route('id'); // Si vous avez une route pour afficher un voyage individuel
        $voyage = Voyage::find($voyageId);

        if ($voyage && $voyage->type === 'Agence') {
            return redirect()->route('home'); // Redirection vers une page d'erreur ou autre traitement
        }
        return $next($request);
    }
}
