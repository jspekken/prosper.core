<?php

namespace Prosper\Core\Support\Entity\Mapper;

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
 * @package Prosper\Core\Support\Entity\Mapper
 */
class Mapper extends NestedSet
{

    /**
     * Holds the internal reference ID.
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

        // Generate the internal reference ID. This can later
        // be used to reference elements from javascript.
        $this->setRefId(str_random(5));

        // Try to call the property setter methods.
        foreach ($properties as $key => $value) {
            if (method_exists($this, $method = 'set' . studly_case($key))) {
                $this->$method($value);
            }
        }
    }

    /**
     * Get the internal reference ID (IRID) for this instance.
     * The IRID is usually used for referenceing javascript events.
     *
     * @return string
     */
    public function getRefId()
    {
        return 'prosper.entry.' . $this->refId;
    }

    /**
     * Set the internal reference ID for this instance.
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
}