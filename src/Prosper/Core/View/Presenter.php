<?php

namespace Prosper\Core\View;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Presenter
 * @package Prosper\Core\View
 */
abstract class Presenter
{

    protected $presenterEntity;

    /**
     * Presenter constructor.
     *
     * @param  mixed  $presenterEntity
     */
    public function __construct($presenterEntity)
    {
        $this->presenterEntity = $presenterEntity;
    }

    /**
     * Allow for property-style attribute getting.
     *
     * @param  string  $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->presenterEntity->{$property};
    }
}