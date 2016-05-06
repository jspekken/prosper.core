<?php

namespace Prosper\Core\View\UI;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Factory
 * @package Prosper\Core\View\UI
 */
class Factory
{

    public function make($entity, $action = null)
    {
        if ($action === null) {
            list($entity, $action) = explode('@', $entity);
        }

        return (new $entity)->setAction($action);
    }
}