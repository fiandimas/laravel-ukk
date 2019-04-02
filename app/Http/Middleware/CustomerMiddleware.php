<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Session::get('login')){
            return redirect('/login');
        }else{
            if(!Session::get('customer')){
                abort('403');
            }else{
                return $next($request);
            }
        }
        
    }
}
