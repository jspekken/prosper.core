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

    require_once __DIR__ . '/routes/dashboard.php';
    require_once __DIR__ . '/routes/users.php';
    require_once __DIR__ . '/routes/websites.php';

});