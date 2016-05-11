<?php

namespace Prosper\Core\Admin\Fields;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Field
 * @package Prosper\Core\Admin\Fields
 */
abstract class Field
{

    /**
     * Holds the field properties.
     * @var array
     */
    protected $properties = [];

    /**
     * Field constructor.
     *
     * @param  array  $properties
     */
    public function __construct(array $properties = [])
    {
        foreach ($properties as $property => $value) {
            $this->$property = $value;
        }
    }

    /**
     * `Magic` property getter method. This function automatically
     * tries to call the corresponding property getter method.
     *
     * @param  string  $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        // Try to call the property setter methods.
        if (method_exists($this, $method = 'get' . studly_case($property))) {
            return $this->$method();
        }

        return $this->properties[$property];
    }

    /**
     * `Magic` property setter method. This function automatically
     * tries to call the corresponding property setter method.
     *
     * @param  string  $property
     * @param  mixed   $value
     *
     * @return mixed
     */
    public function __set($property, $value)
    {
        // Try to call the property setter methods.
        if (method_exists($this, $method = 'set' . studly_case($property))) {
            $value = $this->$method($value);
        }

        $this->properties[$property] = $value;
    }
}