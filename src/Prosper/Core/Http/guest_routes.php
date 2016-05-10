<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

app('router')->group(['namespace' => 'Prosper\Core\Http\Controllers'], function () {
    app('router')->resource('auth/sessions', 'Auth\SessionsController');

    // Override GET: auth/sessions/create
    app('router')->get('sign-in', [
        'as'   => prosper_route_string('auth.sessions.create'),
        'uses' => 'Auth\SessionsController@create'
    ]);

    require __DIR__ . '/routes/springboard.php';
});