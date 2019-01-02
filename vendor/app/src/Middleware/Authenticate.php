<?php

namespace App\Middleware;
use Closure;
use Plugins\CTOKEN\CTOKEN;
use Dimension3\core\DB;

class Authenticate
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
        if (! isset($_SESSION['user'])) {

            return 'Error Authenticate. Please <a href="/login">login</a>';

        }else if (isset($_SESSION['user'])) {

            $CTOKEN = new CTOKEN(CTOKEN_KEY);
            $tokenParams = [
                    'name'  => (isset($_REQUEST['user'])) ? $_REQUEST['user']: '',
                    'pass'  => (isset($_REQUEST['pass'])) ? $_REQUEST['pass']: '',
                    'nri'   => '0000000000'
            ];
            $token = $CTOKEN->encode($tokenParams);
            $params = [
                urlencode($token),
                '"'.$tokenParams['name'].'"',
                '0000000000',
                '',
                '',
                '"'.$tokenParams['pass'].'"',
            ];
            $params = implode('#', $params);
            $return = DB::d3('Xlogin.6.support',$params);
            $status = explode('#', $return[0]);

            if ($status === '1'){}

        }

        return $next($request);
    }

}
