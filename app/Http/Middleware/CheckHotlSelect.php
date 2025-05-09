<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\callback;

class CheckHotlSelect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifiez si l'utilisateur a sélectionné un agence
        if(!session('selected_agence')){
            // Redirigez vers la page de sélection d'agence
            // return redirect()->route('agences.switch-agence')->with('error', 'Veuillez sélectionner un agence.');
            return redirect()->back()->with('error', 'Veuillez sélectionner un agence.');
        }
        return $next($request);
    }
}
