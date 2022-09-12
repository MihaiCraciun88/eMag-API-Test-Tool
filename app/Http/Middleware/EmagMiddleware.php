<?php
namespace App\Http\Middleware;

use App\Services\EmagService;
use Illuminate\Support\Facades\Auth;

class EmagMiddleware
{
    public function handle($request, $next)
    {
        $credentials = [
            'email'     => $request->headers->get('php-auth-user'),
            'password'  => $request->headers->get('php-auth-pw'),
        ];

        if (!Auth::once($credentials)) {
            return response(EmagService::response([], 'ERROR: You are not allowed to use this API', true));
        }

        $userIps = $request->user()->ips->pluck('ip')->map(function($long) {
            return long2ip($long);
        });
        if (!in_array($request->ip(), $userIps->toArray())) {
            return response(EmagService::response([], sprintf('ERROR: Invalid vendor ip [%s]', $request->ip()), true));
        }

        return $next($request);
    }
}