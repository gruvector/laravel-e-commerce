<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorization
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $permission
     * @param string $to
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $permission, $to = '')
    {
        if (! auth()->user()->hasAccess($permission)) {
            return $this->handleUnauthorizedRequest($request, $permission);
        }

        return $next($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param string $permission
     * @return \Illuminate\Http\Response
     */
    private function handleUnauthorizedRequest(Request $request, $permission)
    {
        if ($request->ajax()) {
            abort(401, 'Unauthorized.');
        }

        return back()->withError(trans('admin::messages.permission_denied', ['permission' => $permission]));
    }
}
