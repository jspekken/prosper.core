<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

app('router')->get('module/{module}',           'AdminController@index');
app('router')->get('module/{module}/create',    'AdminController@create');
app('router')->post('module/{module}',          'AdminController@store');
app('router')->get('module/{module}/{id}',      'AdminController@show');
app('router')->get('module/{module}/{id}/edit', 'AdminController@edit');
app('router')->put('module/{module}/{id}',      'AdminController@update');
app('router')->delete('module/{module}',        'AdminController@destroy');