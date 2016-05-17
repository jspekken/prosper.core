<?php

namespace Prosper\Core\Admin\Builders;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Admin\Support\Result;

/**
 * Class FormBuilder
 * @package Prosper\Core\Admin\Builders
 */
class FormBuilder extends Builder
{

    public function build($key = null)
    {
        $mapper = $this->getMapper();
        $model  = $this->getController()->getModel();
        $query  = $model::find($key) ?: [];

        $result = new Result;
        $result->key = $key;

        foreach ($mapper->all() as $field) {
            $clone = clone $field;
            $name  = $clone->name;

            $clone->value = isset($query->{$name}) ? $query->{$name} : null;

            $result->fields->put($name, $clone);
        }

        $this->data = $result;

        return $this;
    }
}