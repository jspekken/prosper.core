<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

app('router')->get('/', [
    'as'   => prosper_route_string('dashboard.index'),
    'uses' => 'DashboardController@index'
]);