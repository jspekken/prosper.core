<?php

namespace Prosper\Core\Http\Middleware;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Authenticate
 * @package Prosper\Core\Http\Middleware
 */
class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return \Illuminate\Http\Response
     */
    public function handle($request, \Closure $next)
    {
        if (app('auth')->guard()->guest()) {
            // No redirects for ajax requests.
            if ($request->ajax()) {
                return response('Unauthotized', 401);
            }

            // If we cannot authenticate the current user
            // then just redirect to the login screen.
            return redirect()->guest(prosper_route('auth.sessions.create'));
        }

        // Nothing to see here, move along...
        return $next($request);
    }
}