<?php

namespace App\Http\Middleware;

use App\Users;
use \Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        return Auth::getUser()->checkRole(Users::ROLE_ADMIN) ? $next($request) : abort(404);
    }
}
