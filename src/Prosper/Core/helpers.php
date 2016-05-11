<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('admin')) {

    /**
     * Instantiate (or make) a new Admin Controller instance.
     *
     * @param  string       $entity
     * @param  null|string  $action
     *
     * @return Prosper\Core\Admin\Controller
     */
    function admin($entity, $action = null)
    {
        return Prosper\Core\Admin\Factory::make($entity, $action);
    }
}

if (!function_exists('prosper_route_string')) {

    /**
     * Generate a named route string.
     *
     * @param  string  $name
     *
     * @return string
     */
    function prosper_route_string($name)
    {
        return sprintf('%s.%s', config('prosper.core.uri'), $name);
    }
}

if (!function_exists('prosper_route')) {

    /**
     * Generate a URL to a named route.
     *
     * @param  string                     $name
     * @param  array                      $parameters
     * @param  bool                       $absolute
     * @param  \Illuminate\Routing\Route  $route
     *
     * @return string
     */
    function prosper_route($name, $parameters = [], $absolute = true, $route = null)
    {
        return route(prosper_route_string($name), $parameters, $absolute, $route);
    }
}