<?php

namespace App\Http\Middleware;

use Closure;

class AutorizacaoMiddleware
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

    if(\Auth::guest()) {
        return redirect('/login');
    }

    if( \Auth::user()->permission == null ) {
       return redirect('/');
    }

    if( ( \Auth::user()->permission == 3 )
        && (!$request->is('requisicao'))   
        && (!$request->is('user/minhaconta')) 
        && (!$request->is('minhas-requisicoes*'))  ) 
    {
        return redirect('/requisicao');
    }


    if( $request->is('user/gerenciar') && \Auth::user()->permission != 1) {
       return redirect('/home');
    }

    return $next($request);
    }
}
