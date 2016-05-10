<?php

namespace Prosper\Core\View\Admin;

/**
 * Class Factory
 * @package Prosper\Core\View\Admin
 */
class Factory
{

    /**
     * @param  string       $entity
     * @param  null|string  $action
     *
     * @return Entity
     */
    public static function make($entity, $action = null)
    {
        if ($action === null) {
            list($entity, $action) = explode('@', $entity);
        }

        return (new $entity)->setAction($action);
    }
}