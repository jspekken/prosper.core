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

    require __DIR__ . '/routes/auth.php';
    require __DIR__ . '/routes/dashboard.php';
    require __DIR__ . '/routes/modules.php';
    require __DIR__ . '/routes/users.php';

});