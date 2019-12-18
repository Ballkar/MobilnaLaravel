<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiCommunication;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class HasRole
{
    use ApiCommunication;


    /**
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return RedirectResponse|Redirector|mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        if ($user->role_id !== +$role) {
            return $this->sendError("You are not allowed to make this action", 403);
        }

        return $next($request);
    }
}
