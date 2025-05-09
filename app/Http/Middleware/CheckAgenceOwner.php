<?php

namespace App\Http\Middleware;

use App\Models\Agence;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAgenceOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
    // Récupère soit l'ID (string), soit l'instance de Agence
    $param = $request->route()->parameter('agence');

    // Si c'est une string, on convertit :
    $agence = $param instanceof Agence
        ? $param
        : Agence::find($param);

        // dd($agence);
        // var_dump($agence->mat_user);
        if(!$agence || $agence->mat_user !== Auth::id()){
            // Si l'utilisateur n'est pas le propriétaire de l'agence, redirigez-le
            return redirect()->route('dashboard')->with('error','vous n\'avez pas accès à cette page');
        }
       
        return $next($request);
    }
}
