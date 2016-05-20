<?php

namespace Prosper\Core\Exceptions\Admin;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class MissingFieldPropertyException
 * @package Prosper\Core\Exceptions\Admin
 */
class MissingFieldPropertyException extends \InvalidArgumentException
{

    /**
     * The name of the property.
     * @var null|string
     */
    protected $property = null;

    /**
     * MissingFieldPropertyException constructor.
     * 
     * @param  string  $property
     */
    public function __construct($property)
    {
        $this->property = $property;
    }

    /**
     * Gets the Exception message.
     * 
     * @return string
     */
    public function getMessage()
    {
        return sprintf('Missing field property `%s`.', $this->property);
    }
}