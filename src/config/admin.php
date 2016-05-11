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

    'controllers' => [
        'pages' => Prosper\Core\Admin\Controllers\PageController::class
    ],

    'fields' => [
        'text' => Prosper\Core\Admin\Fields\TextField::class
    ]
];