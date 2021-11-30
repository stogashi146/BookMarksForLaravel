<?php

namespace App\Http\Middleware;

use Closure;

class RequestLogger
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
        if (env('DEBUG_REQUEST', false)) {
            $this->_writeLog($request);
        }
        return $next($request);
    }

    private function _writeLog($request): void
    {
        \Log::channel('request')->debug(
            $request->method()
            . " : "
            . json_encode(
                ['url' => $request->fullUrl(), 'request' => $request->all(), 'header' => $request->headers->all()],
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            )
        );
    }
}