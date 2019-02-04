<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 24/09/2018
 * Time: 12:38 PM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AllowOnlyAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->is_admin) {
            return $next($request);
        }

        abort(403);
    }
}