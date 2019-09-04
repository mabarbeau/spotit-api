<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
  public function handle($request, Closure $next)
  {
    $allowedOrigins = ['localhost', 'http://spotit.local:8080'];

    $origin = $request->server('HTTP_ORIGIN');

    if (in_array($origin, $allowedOrigins)) {
      return $next($request)
        ->header('Access-Control-Allow-Origin', $origin)
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
    return $next($request);
  }
}
