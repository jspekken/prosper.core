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

use Prosper\Core\Admin\Mappers\Mapper;

/**
 * Class Field
 * @package Prosper\Core\Admin\Fields
 */
abstract class Field
{

    const CONTEXT_LIST   = 'list';
    const CONTEXT_FORM   = 'form';
    const CONTEXT_FILTER = 'filter';

    /**
     * Holds the field properties.
     * @var array
     */
    protected $properties = [];

    /**
     * Holds the Mapper instance.
     * @var Mapper
     */
    protected $mapper;

    /**
     * Holds the current context.
     * @var string
     */
    protected $context = self::CONTEXT_LIST;

    /**
     * Field constructor.
     *
     * @param  Mapper  $mapper
     * @param  array   $properties
     */
    public function __construct(Mapper $mapper, array $properties = [])
    {
        foreach ($properties as $property => $value) {
            $this->$property = $value;
        }

        $this->setMapper($mapper);
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

    /**
     * Check that a property is set.
     *
     * @param  string  $property
     *
     * @return bool
     */
    public function __isset($property)
    {
        return isset($this->properties[$property]);
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
    public function setMapper($mapper)
    {
        $this->mapper = $mapper;

        return $this;
    }

    /**
     * Get the Controller instance.
     *
     * @return null|\Prosper\Core\Admin\Controller
     */
    public function getController()
    {
        return $this->getMapper()->getController();
    }

    /**
     * Get the module identifier.
     *
     * @return string
     */
    public function getModule()
    {
        return $this->getController()->getModule();
    }

    /**
     * Try to get the label property. If it's
     * not set, return the field name.
     *
     * @return mixed|string
     */
    public function getLabel()
    {
        return isset($this->label)
            ? $this->properties['label']
            : title_case($this->name);
    }

    /**
     * Get the field value. Whenever a 'before' property is set on the
     * field that property will be executed as a closure and the
     * returned value will be the new field value.
     *
     * @return mixed
     */
    public function getValue()
    {
        $value = $this->properties['value'];

        // Try to get call the before closure.
        if (isset($this->before) && is_callable($this->before)) {
            $closure = $this->properties['before'];

            $value = $closure($value);
        }

        return $value;
    }

    /**
     * Render the field.
     *
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function render()
    {
        return view($this->getView(), [
            'field' => $this
        ])->render();
    }

    /**
     * Get the view name.
     *
     * @return string
     */
    protected function getView()
    {
        return property_exists($this, 'view')
            ? $this->view
            : sprintf('prosper.core::components.admin.fields.' . $this->disectFieldname());
    }

    /**
     * Disect the classname of the current field
     * to get the name of the field.
     *
     * @return string
     */
    protected function disectFieldName()
    {
        return snake_case(str_replace_last('Field', '', class_basename($this)), '-');
    }
}