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

use Prosper\Core\Context;

/**
 * Class Springboard
 * @package Prosper\Core\Http\Middleware
 */
class Springboard
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
        // Whenever we're viewing anything on the backend and
        // we're logged in, we need to check some stuff.
        if (app('prosper.context') == Context::BACKEND && app('auth')->check()) {
            // Do nothing when the current user is
            // viewing the springboard screen.
            if (app('request')->segment(2) != 'springboard') {
                $project = session('prosper.project');

                // No project set in our session? Try again by redirecting
                // the current user to the springboard screen.
                if (!$project) {
                    return redirect()->to(prosper_route('auth.springboard.index'));
                }

                // Check to see if the user has access to the current project.
                if (!policy($project)->access(app('auth')->user(), $project)) {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}