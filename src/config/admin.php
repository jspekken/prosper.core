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
        'pages' => Prosper\Core\View\Admin\Controllers\PageController::class
    ],

    'fields' => [
        'text' => Prosper\Core\View\Admin\Fields\TextField::class
    ]
];