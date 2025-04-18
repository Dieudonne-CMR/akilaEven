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
        // Vérifiez si l'utilisateur a sélectionné un hôtel
        if(!session('selected_hotel')){
            // Redirigez vers la page de sélection d'hôtel
            // return redirect()->route('hotels.switch-hotel')->with('error', 'Veuillez sélectionner un hôtel.');
            return redirect()->back()->with('error', 'Veuillez sélectionner un hôtel.');
        }
        return $next($request);
    }
}
