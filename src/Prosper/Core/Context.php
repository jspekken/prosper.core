<?php

namespace Prosper\Core;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Context
 * @package Prosper\Core
 */
abstract class Context
{

    /**
     * <code>
     *      (app('prosper.context') === Prosper\Core\Context::FRONTEND)
     * </code>
     */
    const FRONTEND = 'frontend';
    const BACKEND  = 'backend';
}
