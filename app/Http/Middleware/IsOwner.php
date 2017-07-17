<?php

namespace App\Http\Middleware;

use App\Album;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsOwner
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

        if(Auth::user()!=null || Auth::user()['type']==2)
        {
            $album=Album::find($request->album);
            if($album!=null && $album->user_id==Auth::user()['id'])
            {
                return $next($request);
            }
            return redirect('/');

        }
        return redirect('login');

    }
}
