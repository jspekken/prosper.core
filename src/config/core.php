<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
     * Package URI.
     * @var string
     */
    'uri' => 'backend',

    /*
     * Auth filter.
     * Only runs on guarded routes.
     */
    'auth' => Prosper\Core\Http\Middleware\Authenticate::class,

    /*
     *
     */
    'middleware' => [
        /*
         * The middlewares registerd on the web group are automatically
         * added to the request when registering your routes through
         * the prosper.router instance.
         */
        'web' => [
            Prosper\Core\Http\Middleware\Springboard::class
        ]
        // ...
    ]
];