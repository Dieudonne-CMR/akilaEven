<?php

namespace App\Http\Middleware;

use App\Models\Hotel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckHotelOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
    // Récupère soit l'ID (string), soit l'instance de Hotel
    $param = $request->route()->parameter('hotel');

    // Si c'est une string, on convertit :
    $hotel = $param instanceof Hotel
        ? $param
        : Hotel::find($param);

        // dd($hotel);
        // var_dump($hotel->mat_user);
        if(!$hotel || $hotel->mat_user !== Auth::id()){
            // Si l'utilisateur n'est pas le propriétaire de l'hôtel, redirigez-le
            return redirect()->route('dashboard')->with('error','vous n\'avez pas accès à cette page');
        }
       
        return $next($request);
    }
}
