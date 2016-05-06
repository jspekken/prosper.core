<?php

namespace Prosper\Core\View\UI\Support;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Text
 * @package Prosper\Core\View\UI\Support
 */
class Text
{

    /**
     * Holds the current string.
     * @var string
     */
    protected $text = '';

    /**
     * `Magic` string caster.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param  string  $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}