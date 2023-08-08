<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting\RequestModel;


class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);

        $path = $request->path();
        $routeName = $request->route() ? $request->route()->getName() : null;
        $ipAddress = $request->ip();

         // Store the request log in the database
         RequestModel::create([
            'payload' => $path. " -request- ".request()->ip(). " serverip- ". $_SERVER['SERVER_ADDR'],
            'route' => $routeName,
            'link' => $ipAddress,
         ]);

    return $response;

    }
}
