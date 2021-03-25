<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsManager
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

        $user = Auth::user();
        if($user->isManager() || $user->isAdmin())
        {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('warning', 'У вас нет доступа в данный раздел');
        
    }
}
