<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   
     // app/Http/Middleware/CheckUserRole.php

    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->u_a_mngt == 1) {
            return $next($request);
        }
        else
        {
            return redirect('/');
        }

        
    }

}