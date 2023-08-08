<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting\IPAddressModel;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    

         // Fetch server information from the database
        $serverInfo = IPAddressModel::first(); // Fetch the server information from the database

           // Get the allowed IP addresses from the server info
        $allowedIPs = explode(',', $serverInfo->ip_address);

         // Check if the client's IP address is allowed
        $clientIP =  isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : request()->ip();

        if (!in_array($clientIP, $allowedIPs)) {
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

            return response()->json([
                'status' => 401,  'message' => $responseMessage,
            ], Response::HTTP_BAD_REQUEST);
        }

        $appSecret = $serverInfo->appSecret; 
        $appToken = $serverInfo->appToken;


        // Check if headers are correct
        $requestSecret = $request->header('appSecret');
        $requestClient = $request->header('appToken');

         // Check if the required headers are not empty and match the expected values
        if (empty($requestSecret) || empty($requestClient) || $requestSecret !== $appSecret || $requestClient !== $appToken) {
            return response()->json([
                'status' => 401, 'message' => 'Required parameters to process your request is missing or Header Information is Invalid' . $request->header('appSecret'),
            ], Response::HTTP_BAD_REQUEST);
        }

         // Share the data with the views
         view()->share('serverInfo', $serverInfo);
    
        // Attach the header secret and client to the request as headers
        $request->headers->add([
            'appSecret' => $appSecret,
            'appToken' => $appToken,
        ]);


        return $next($request);
    }
}
