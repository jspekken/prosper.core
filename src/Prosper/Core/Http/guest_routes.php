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

    app('router')->get('springboard', [
        'as'   => prosper_route_string('auth.springboard.index'),
        'uses' => 'Auth\SpringboardController@index'
    ]);

    app('router')->get('springboard/create', [
        'as'   => prosper_route_string('auth.springboard.create'),
        'uses' => 'Auth\SpringboardController@create'
    ]);

    app('router')->post('springboard/create', [
        'as'   => prosper_route_string('auth.springboard.store'),
        'uses' => 'Auth\SpringboardController@store'
    ]);

    app('router')->get('springboard/{project}', [
        'as'   => prosper_route_string('auth.springboard.open'),
        'uses' => 'Auth\SpringboardController@open'
    ]);
});