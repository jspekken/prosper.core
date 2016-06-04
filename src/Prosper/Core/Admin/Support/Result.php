<?php

namespace Prosper\Core\Admin\Support;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Result
 * @package Prosper\Core\Admin\Support
 */
class Result
{

    /**
     * Holds the primary key (usually the ID).
     * @var int|string
     */
    public $key;

    /**
     * Holds the result fields.
     * @var \Illuminate\Support\Collection
     */
    public $fields;

    /**
     * Result constructor.
     */
    public function __construct()
    {
        $this->fields = collect();
    }
}