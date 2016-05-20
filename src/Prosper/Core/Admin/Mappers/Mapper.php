<?php

namespace Prosper\Core\Admin\Mappers;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Exceptions\Admin\MissingFieldPropertyException;
use Prosper\Core\Admin\Controller;

/**
 * Class Mapper
 * @package Prosper\Core\Admin\Mappers
 */
abstract class Mapper
{

    /**
     * The controller instance.
     * @var null|Controller
     */
    protected $controller = null;

    /**
     * Holds the collection of fields.
     * @var \Illuminate\Support\Collection
     */
    protected $fields;

    /**
     * Mapper constructor.
     *
     * @param  Controller  $controller
     */
    public function __construct($controller)
    {
        $this->fields = collect();

        $this->setController($controller);
    }

    /**
     * Add a new field to the mapper.
     *
     * @param  string  $type
     * @param  array   $arguments
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function add($type, array $arguments)
    {
        $namespace = config('prosper.admin.fields')[$type];

        if (!isset($arguments['name'])) {
            throw new MissingFieldPropertyException('name');
        }

        $this->fields->put($arguments['name'], new $namespace($this, $arguments));

        return $this;
    }

    /**
     * Get the collection of fields.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->fields;
    }

    /**
     * Get the Controller instance.
     *
     * @return null|Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the Controller instance.
     *
     * @param  null|Controller  $controller
     *
     * @return $this
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }
}