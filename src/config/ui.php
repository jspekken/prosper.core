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

    'field-types' => [
        /*
         * Layout widgets
         */
        'layout.grid.column' => Prosper\Core\View\UI\Widgets\Layout\Grid\Column::class,
        'layout.grid.row'    => Prosper\Core\View\UI\Widgets\Layout\Grid\Row::class,

        /*
         * Content widgets
         */
        'content.title' => Prosper\Core\View\UI\Widgets\Content\Title::class
    ]

];