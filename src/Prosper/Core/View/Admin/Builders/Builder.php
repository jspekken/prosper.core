<?php

namespace Prosper\Core\View\Admin\Builders;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\View\Admin\Mappers\Mapper;

/**
 * Class Builder
 * @package Prosper\Core\View\Admin\Builders
 */
abstract class Builder
{

    /**
     * Holds the builder data results.
     * @var null|\Illuminate\Support\Collection
     */
    public $data = null;

    /**
     * The current Mapper instance.
     * @var null|Mapper
     */
    protected $mapper = null;

    /**
     * Builder constructor.
     *
     * @param  Mapper  $mapper
     */
    public function __construct(Mapper $mapper)
    {
        $this->data = collect();

        $this->setMapper($mapper);
    }

    /**
     * @return mixed
     */
    abstract public function build();

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
}