<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use App\Models\Appointment;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::check()){
            if (Auth::user()->usertype('0')) {
                return true;
            }else{
                return view('admin.showappointment')->with('user',Auth::user());
            }
        }else{
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
