<?php

namespace App\Middleware;
use Closure;
use Plugins\CTOKEN\CTOKEN;

class StartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (session_status() == PHP_SESSION_NONE) {

            session_start();
            $CTOKEN = new CTOKEN(CTOKEN_KEY);
            $params = [
                    'name'  => (isset($_REQUEST['user'])) ? $_REQUEST['user']: '',
                    'pass'  => (isset($_REQUEST['pass'])) ? $_REQUEST['pass']: '',
                    'nri'   => '0000000000'
            ];
            $_SESSION['user']['token'] = $CTOKEN->encode($params);

        }

        return $next($request);
    }
}
