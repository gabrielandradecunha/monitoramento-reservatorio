<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        // Verifica se o usuário autenticado é admin
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Caso contrário, redireciona para a página inicial
        return redirect('/dashboard');
    }
}
