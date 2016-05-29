<?php

namespace Prosper\Core\Admin;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Admin\Builders\ListBuilder;
use Prosper\Core\Admin\Builders\FormBuilder;
use Prosper\Core\Admin\Mappers\ListMapper;
use Prosper\Core\Admin\Mappers\FormMapper;
use Prosper\Core\Admin\Builders\Builder;
use Illuminate\Database\Eloquent\Model;
use Prosper\Core\Admin\Mappers\Mapper;

/**
 * Class Controller
 * @package Prosper\Core\Admin
 */
class Controller
{

    /**
     * Get the items per page count.
     * @var int
     */
    public $perPage = 25;

    /**
     * The model instance.
     * @var null|Model
     */
    protected $model = null;

    /**
     * Holds the module identifier.
     * @var string
     */
    protected $module;

    /**
     * The current action name.
     * @var string
     */
    protected $action;

    /**
     * The current Mapper instance.
     * @var null|Mapper
     */
    protected $mapper = null;

    /**
     * The current Builder instance.
     * @var null|Builder
     */
    protected $builder = null;

    /**
     * Holds the current view path.
     * @var null|string
     */
    protected $view = null;

    /**
     * Get the current Eloquent model instance.
     *
     * @return null|Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the current Eloquent model instance.
     *
     * @param  Model  $model
     *
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get the module identifier.
     *
     * @return string
     */
    public function getModule()
    {
        if (!$module = $this->module) {
            $module = app('request')->route('module');
        }

        return $module;
    }

    /**
     * Set the module identifier.
     *
     * @param  string  $module
     *
     * @return $this
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get the current executing action name.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the current executing action name.
     *
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
     * Get the current Mapper instance.
     *
     * @return null|Mapper
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * Set the current Mapper instance.
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
     * Get the current Builder instance.
     *
     * @return null|Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Set the current Builder instance.
     *
     * @param  Builder  $builder
     *
     * @return $this
     */
    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * Set the current executing methods.
     *
     * @param  string|array     $method
     * @param  int|string|null  $key
     *
     * @return $this
     */
    public function build($method, $key = null)
    {
        if (is_array($method)) {
            array_map(function ($method) use ($key) {
                $this->build($method, $key);
            }, $method);

            return $this;
        }

        // Execute the specific build method. These methods will
        // setup the mapper and builder instances and will
        // ultimately trigger the configure methods.
        $this->{'build' . studly_case($method)}($key);

        return $this;
    }

    /**
     * Build the list view.
     *
     * @throws \RuntimeException
     * @return $this
     */
    protected function buildList()
    {
        if (!method_exists($this, 'configureList')) {
            throw new \RuntimeException('Please implement the `configureList` method.');
        }

        $this->setMapper($mapper = new ListMapper($this));
        $this->configureList($mapper);

        $this->setBuilder((new ListBuilder($this, $mapper))->build());

        return $this;
    }

    /**
     * Build the form view.
     *
     * @param  int|string  $key
     *
     * @throws \RuntimeException
     * @return $this
     */
    protected function buildForm($key)
    {
        if (!method_exists($this, 'configureForm')) {
            throw new \RuntimeException('Please implement the `configureForm` method.');
        }

        $this->setMapper($mapper = new FormMapper($this));
        $this->configureForm($mapper);

        $this->setBuilder((new FormBuilder($this, $mapper))->build($key));

        return $this;
    }

    protected function buildFilters()
    {
        // todo: buildFilters
    }

    protected function buildScopes()
    {
        // todo: buildScopes
    }

    public function render($view = null)
    {
        return view($view ?: $this->getView())->with([
            'controller' => $this,
            'mapper'     => $this->getMapper(),
            'builder'    => $this->getBuilder()
        ])->render();
    }

    protected function getView()
    {
        return $this->view ?: sprintf('prosper.core::screens.admin.' . $this->getAction());
    }
}