<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class hasRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $usersCount = User::count();

        if ($usersCount > 0) {
            // Redirecionar para algum lugar, talvez a página inicial
            return redirect()->route('pagina.inicial');
        }
        return $next($request);
    }
}
