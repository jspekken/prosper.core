<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

app('router')->get('module/{module}', [
    'as'   => prosper_route_string('module.index'),
    'uses' => 'AdminController@index'
]);

app('router')->get('module/{module}/create', [
    'as'   => prosper_route_string('module.create'),
    'uses' => 'AdminController@create'
]);

app('router')->post('module/{module}', [
    'as'   => prosper_route_string('module.store'),
    'uses' => 'AdminController@store'
]);

app('router')->get('module/{module}/{id}', [
    'as'   => prosper_route_string('module.show'),
    'uses' => 'AdminController@show'
]);

app('router')->get('module/{module}/{id}/edit', [
    'as'   => prosper_route_string('module.edit'),
    'uses' => 'AdminController@edit'
]);

app('router')->put('module/{module}/{id}', [
    'as'   => prosper_route_string('module.update'),
    'uses' => 'AdminController@update'
]);

app('router')->delete('module/{module}', [
    'as'   => prosper_route_string('module.destroy'),
    'uses' => 'AdminController@destroy'
]);