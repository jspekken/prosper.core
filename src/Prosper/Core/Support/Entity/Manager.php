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

use Prosper\Core\Support\Entity\Mapper\Mapper;

/**
 * Class Manager
 * @package Prosper\Core\Support\Entity
 */
class Manager
{

    /**
     * The name of the current executing action.
     * @var string
     */
    protected $action;

    /**
     * The Mapper instance.
     * @var Mapper
     */
    protected $mapper;

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param  string  $action
     *
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the Mapper instance.
     *
     * @return Mapper
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * Set the Mapper instance.
     *
     * @param  Mapper  $mapper
     *
     * @return $this
     */
    public function setMapper(Mapper $mapper)
    {
        $this->mapper = $mapper;

        return $this;
    }

    /**
     * Execute the current acton.
     *
     * @return $this
     */
    public function execute()
    {
        $this->setMapper($mapper = new Mapper)->{$this->getAction()}($mapper);

        return $this;
    }
}