<?php

namespace Prosper\Core\Database\Traits;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Presentable
 * @package Prosper\Core\Database\Traits
 */
trait Presentable
{

    /**
     * Holds the view presenter instance.
     * @var mixed
     */
    protected $presenterInstance;

    /**
     * Prepare a new or 'cached' presenter instance
     *
     * @return mixed
     */
    public function present()
    {
        if (!$this->presenter || !class_exists($this->presenter)) {
            throw new \InvalidArgumentException('Please set the $presenter property to your presenter path.');
        }

        if (!$this->presenterInstance) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}