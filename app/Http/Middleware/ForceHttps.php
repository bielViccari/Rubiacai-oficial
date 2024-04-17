<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se a requisição não é segura (não HTTPS)
        if (!$request->secure()) {
            // Redireciona para a versão HTTPS da mesma URL
            return redirect()->secure($request->getRequestUri());
        }

        // Continua com a solicitação normalmente
        return $next($request);
    }
}
