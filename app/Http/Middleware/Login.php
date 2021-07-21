<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use Session;

class Login
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
        if($ssidthanhvien = Session::get('ssidthanhvien')!=null){
            return $next($request);
        }
        else{
            return redirect()->route('dangnhapthanhvien');
        }
    }
}
