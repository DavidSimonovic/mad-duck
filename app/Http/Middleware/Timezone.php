<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Timezone
{
    /**
     * Handle an incoming request.
     *
     * @param Request                                       $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $temp_timezone = $request->header('X-timezone') ?: null;

        if (!$temp_timezone) {

            $local = Auth::user()->timezone->name;
        } else {
            $local = $temp_timezone;
        }

        config(['app.timezone' => $local]);

        return $next($request);

    }
}
