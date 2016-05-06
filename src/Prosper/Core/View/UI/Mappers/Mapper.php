<?php

namespace Prosper\Core\View\UI\Mappers;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Support\NestedSet;

/**
 * Class Mapper
 * @package Prosper\Core\View\UI\Mappers
 */
class Mapper extends NestedSet
{

    /**
     * The internal reference ID.
     * @var string
     */
    protected $refId;

    /**
     * Mapper constructor.
     *
     * @param  array  $properties
     * @param  array  $children
     */
    public function __construct(array $properties = [], array $children = [])
    {
        parent::__construct($children);

        // Generate the Internal Reference ID. This can later, for example,
        // be used to reference widgets elements from javascript.
        $this->setRefId(str_random(5));

        // Try to call the property setter methods.
        foreach ($properties as $key => $value) {
            if (method_exists($this, $method = 'set' . studly_case($key))) {
                $this->{$method}($value);
            }
        }
    }

    /**
     * `Magic|Convenience` property getter method. This automatically calls
     * the getter methods for the property you are currently getting.
     * E.g. $instance->prop calls the $instance->getProp() method.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, $method = 'get' . studly_case($key))) {
            return $this->{$method}();
        }

        return null;
    }

    /**
     * `Magic|Convenience` property setter method. This automatically calls
     * the setter methods for the property you are currently setting.
     * E.g. $instance->prop = $value calls $instance->setProp($value).
     *
     * @param  string  $key
     * @param  string  $value
     *
     * @return mixed
     */
    public function __set($key, $value)
    {
        if (method_exists($this, $method = 'set' . studly_case($key))) {
            return $this->{$method}($value);
        }

        return null;
    }

    /**
     * Get the internal reference ID (IRID) for this instance.
     * The IRID is used for referencing javascripts events.
     *
     * @return string
     */
    public function getRefId()
    {
        return 'prosper.ui.' . $this->refId;
    }

    /**
     * Get the internal reference ID for this instance. This can
     * later be used to reference elements from javascript.
     *
     * @param  string  $refId
     *
     * @return $this
     */
    public function setRefId($refId)
    {
        $this->refId = $refId;

        return $this;
    }

    /**
     * Add a new widget to the nested set.
     *
     * @param  string    $type
     * @param  array     $properties
     * @param  callable  $children
     *
     * @return $this
     */
    public function add($type, $properties = [], callable $callback = null)
    {
        $namespace = $this->getFieldNamespace($type);
        $instance  = new $namespace(!is_callable($properties) ? $properties : []);

        if (is_callable($properties)) {
            $properties($instance);
        }

        return $this->addChild($instance);
    }

    /**
     * Retreive the widget namespace.
     *
     * @param  string  $type
     *
     * @return \Prosper\Core\View\UI\Widgets\Widget
     * @throws \InvalidArgumentException
     */
    protected function getFieldNamespace($type)
    {
        $types = config('prosper.ui')['field-types'];

        if (isset($types[$type])) {
            return $types[$type];
        }

        throw new \InvalidArgumentException(sprintf('Unable to find the %s widget.', $type));
    }

    /**
     * Get the rendered view.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view($this->view)->with([
            'node' => $this
        ])->render();
    }
}