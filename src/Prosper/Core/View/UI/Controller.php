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

use Prosper\Core\View\UI\Mappers\Mapper;

/**
 * Class Controller
 * @package Prosper\Core\View\UI
 */
class Controller
{

    /**
     * Holds the current controller action.
     * @var string
     */
    protected $action;

    /**
     * Holds the Mapper instance.
     * @var null|Mapper
     */
    protected $mapper = null;

    /**
     * The default view path.
     * @var string
     */
    protected $view = 'prosper.core::screens.ui.default';

    /**
     * Get the current controller action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the current controller action.
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
     * Get the Mapper instance.
     *
     * @return null|Mapper
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * Set the Mapper instance.
     *
     * @param  null|Mapper  $mapper
     *
     * @return $this
     */
    public function setMapper($mapper)
    {
        $this->mapper = $mapper;

        return $this;
    }

    public function execute()
    {
        $this
            ->setMapper($mapper = new Mapper)
            ->{$this->getAction()}($mapper);

        return $this;
    }

    public function render($view = null)
    {
        return view($view ?: $this->view)->with([
            'entity' => $this,
            'mapper' => $this->getMapper()
        ])->render();
    }
}