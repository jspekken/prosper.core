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

use Prosper\Core\Exceptions\Admin\MissingFieldPropertyException;

/**
 * Class AutoLinkField
 *
 * @package   Prosper\Core\Admin\Fields
 * @property  string      resource
 * @property  int|string  key
 */
class AutoLinkField extends Field
{

    /**
     * Default field properties.
     * @var array
     */
    public $properties = [
        'resource' => 'edit'
    ];

    /**
     * Get the url.
     *
     * @return string
     */
    public function getUrl()
    {
        if (!isset($this->resource)) {
            throw new MissingFieldPropertyException('resource');
        }

        return prosper_route(sprintf('module.%s', $this->resource), [$this->getModule(), $this->key]);
    }
}