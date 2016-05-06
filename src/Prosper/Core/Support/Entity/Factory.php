<?php

namespace Prosper\Core\Support\Entity;

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
 * @package Prosper\Core\Support\Entity
 */
class Factory
{

    /**
     * @param  string       $entity
     * @param  null|string  $action
     *
     * @return Manager
     */
    public static function make($entity, $action = null)
    {
        if ($action === null) {
            list($entity, $action) = explode('@', $entity);
        }

        return (new $entity)->setAction($action);
    }
}