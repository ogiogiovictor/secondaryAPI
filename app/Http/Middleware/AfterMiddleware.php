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
        
              $responseMessage = 'Unauthorized IP Address';

                if (isset($_SERVER['HTTP_HOST'])) {
                    $responseMessage .= ' - HTTP Host: ' . $_SERVER['HTTP_HOST'];
                }

                if (request()->ip()) {
                    $responseMessage .= ' - Request IP: ' . request()->ip();
                }

                if (isset($_SERVER['SERVER_ADDR'])) {
                    $responseMessage .= ' - Server IP: ' . $_SERVER['SERVER_ADDR'];
                }

         // Store the request log in the database
         RequestModel::create([
            'payload' => $path. " -request- ".$responseMessage ,
            'route' => $routeName,
            'link' => $ipAddress,
         ]);

    return $response;

    }
}
