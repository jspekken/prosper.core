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
 * Class AutoLinkField
 * @package Prosper\Core\Admin\Fields
 */
class AutoLinkField extends Field
{

    /**
     * Default field properties.
     * @var array
     */
    protected $properties = [
        'resource' => 'edit'
    ];

    /**
     * Get the url.
     *
     * @return string
     */
    public function getUrl()
    {
        return prosper_route(sprintf('module.%s', $this->resource), [$this->getModule(), $this->key]);
    }
}