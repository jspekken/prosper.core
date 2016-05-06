<?php

namespace Prosper\Core\View\UI\Widgets\Layout\Grid;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\View\UI\Widgets\Widget;

/**
 * Class Column
 * @package Prosper\Core\View\UI\Widgets\Layout\Column
 */
class Column extends Widget
{

    protected $view = 'prosper.core::components.ui.widgets.layout.grid.column';
    public $width = 'sm-12';

    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }
}