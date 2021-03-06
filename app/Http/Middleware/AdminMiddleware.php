<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AdminMiddleware
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
            return redirect('/admin/login');
        }else{
            if(Session::get('id_level') == 2){
                return $next($request);
            }else{
                abort('403');
            }
        }
    }
}
