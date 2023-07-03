<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

            if(Auth::check()){
                if(Auth::user()->CategoryUser->name_category_users=='admin'){
                    return $next($request);
                }elseif (Auth::user()->CategoryUser->name_category_users=='gerant') {
                    return $next($request);
                }elseif (Auth::user()->CategoryUser->name_category_users=='gestionnaire') {
                    return $next($request);
                }

            }else if(!Auth::check()){
                return redirect()->route('login');
            }else{
                Session::flash('notification.type', 'warning');
                Session::flash('notification.message', "Action non Autoriser");
                return back();
            }



    }

}


