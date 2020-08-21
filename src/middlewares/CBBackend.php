<?php

namespace ersaazis\cb\middlewares;

use App\Http\CBHook;
use Closure;
use ersaazis\cb\helpers\CB;
use CRUD;

class CBBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->guest()) {
            return cb()->redirect(cb()->getLoginUrl("login"),cbLang('please_login_for_first'),'warning');
        }

        (new CBHook())->beforeBackendMiddleware($request);

        $response = $next($request);

        (new CBHook())->afterBackendMiddleware($request, $response);

        return $response;

    }
}
