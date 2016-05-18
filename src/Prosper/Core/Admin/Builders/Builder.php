<?php

namespace Prosper\Core\Admin\Builders;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Eloquent\Model;
use Prosper\Core\Admin\Mappers\Mapper;
use Prosper\Core\Admin\Controller;

/**
 * Class Builder
 * @package Prosper\Core\Admin\Builders
 */
abstract class Builder
{

    /**
     * Holds the builder data results.
     * @var null|\Illuminate\Support\Collection
     */
    public $data = null;

    /**
     * The controller instance.
     * @var null|Controller
     */
    protected $controller = null;

    /**
     * The current Mapper instance.
     * @var null|Mapper
     */
    protected $mapper = null;

    /**
     * Builder constructor.
     *
     * @param  Controller  $controller
     * @param  Mapper      $mapper
     */
    public function __construct(Controller $controller, Mapper $mapper)
    {
        $this->data = collect();

        $this
            ->setController($controller)
            ->setMapper($mapper);
    }

    /**
     * @param  mixed  $key
     *
     * @return mixed
     */
    abstract public function build($key = null);

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
     * @param  Controller  $controller
     *
     * @return $this
     */
    public function setController(Controller $controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the current Mapper instance.
     *
     * @return null|Mapper
     */
    protected function getMapper()
    {
        return $this->mapper;
    }

    /**
     * @param  Mapper  $mapper
     *
     * @return $this
     */
    protected function setMapper(Mapper $mapper)
    {
        $this->mapper = $mapper;

        return $this;
    }

    /**
     * Get the related fields set on the model.
     *
     * @param  Model  $model
     *
     * @return array
     */
    protected function getRelations(Model $model)
    {
        $relations = [];

        foreach ($model->getRelations() as $relation) {
            $field = sprintf('%s_%s', str_singular($relation->getTable()), $relation->getKeyName());

            $relations[$field] = $relation->getKey();
        }

        return $relations;
    }
}