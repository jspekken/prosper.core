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

    /**
     * Holds the paginator instance.
     * @var null|\Illuminate\Pagination\LengthAwarePaginator
     */
    public $query = null;

    /**
     * Build the list.
     *
     * @param  null  $key
     *
     * @return $this
     */
    public function build($key = null)
    {
        $controller = $this->getController();
        $mapper     = $this->getMapper();
        $model      = $controller->getModel();

        // Start building the query.
        $query = $model::with([]);
        $query = $query->paginate($controller->perPage);

        foreach ($query as $row) {
            $result = new Result;
            $result->key = $row->getKey();

            // Loop over every field previously mapped in the
            // `configureList()` method in the controller.
            foreach ($mapper->all() as $field) {
                $clone = clone $field;
                $name  = $clone->name;
                $value = isset($row->{$name}) ? $row->{$name} : null;

                $clone->value = $value;
                $clone->row   = $row;
                $clone->key   = $row->getKey();

                // Add the field to the result object.
                $result->fields->put($name, $clone);
            }

            // Push the result to the dataset.
            $this->data->push($result);
        }

        $this->query = $query;

        return $this;
    }
}