<?php

namespace Prosper\Core\View\Admin;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\View\Admin\Builders\ListBuilder;
use Prosper\Core\View\Admin\Mappers\ListMapper;
use Prosper\Core\View\Admin\Builders\Builder;
use Prosper\Core\View\Admin\Mappers\Mapper;

/**
 * Class Controller
 * @package Prosper\Core\View\Admin
 */
class Controller
{

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
     * @param  string|array  $method
     *
     * @return $this
     */
    public function build($method)
    {
        if (is_array($method)) {
            array_map(function ($method) {
                $this->build($method);
            }, $method);

            return $this;
        }

        $this->{'build' . studly_case($method)}();

        return $this;
    }

    protected function buildList()
    {
        if (!method_exists($this, 'configureList')) {
            throw new \InvalidArgumentException('Cannot configure the list.');
        }

        $this->setMapper($mapper = new ListMapper);
        $this->configureList($mapper);

        $this->setBuilder((new ListBuilder($mapper))->build());

        return $this;
    }

    protected function buildFilters()
    {

    }

    protected function buildScopes()
    {

    }

    public function render()
    {
        return view($this->getView())->with([
            'controller' => $this,
            'mapper'     => $this->getMapper(),
            'builder'    => $this->getBuilder()
        ])->render();
    }

    protected function getView()
    {
        return property_exists($this, 'view')
            ? $this->view
            : sprintf('prosper.core::screens.admin.' . $this->getAction());
    }
}