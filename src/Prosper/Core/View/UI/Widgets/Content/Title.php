<?php

namespace Prosper\Core\View\UI\Widgets\Content;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\View\UI\Support\Text;
use Prosper\Core\View\UI\Widgets\Widget;

/**
 * Class Title
 * @package Prosper\Core\View\UI\Widgets\Content\Title
 */
class Title extends Widget
{

    public $text;
    protected $view = 'prosper.core::components.ui.widgets.content.title';

    public function setText($content)
    {
        $this->text = (new Text)->setText($content);

        return $this;
    }
}