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
 * Class ListBuilder
 * @package Prosper\Core\Admin\Builders
 */
class ListBuilder extends Builder
{

    public function build()
    {
        $mapper = $this->getMapper();
        $model  = $this->getController()->getModel();

        $query = $model::with([]);
        $query = $query->paginate();

        foreach ($query as $row) {
            $result = new Result;
            $result->key = $row->getKey();

            foreach ($mapper->all() as $field) {
                $clone = clone $field;
                $name  = $clone->name;

                $clone->value = $row->{$name};

                $result->fields->put($name, $clone);
            }

            $this->data->push($result);
        }

        $this->query = $query;

        return $this;
    }
}