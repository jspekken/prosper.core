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
use Illuminate\Http\Request;

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
            $clone->row   = $query;

            $result->fields->put($name, $clone);
        }

        $this->data = $result;

        return $this;
    }

    /**
     * Store the newly created model in the database.
     *
     * @param  Request  $request
     *
     * @return $this
     */
    public function store(Request $request)
    {
        $model = $this->getController()->getModel();

        (new $model($request->all()))->save();

        return $this;
    }

    /**
     * Update the model.
     *
     * @param  Request     $request
     * @param  int|string  $key
     *
     * @return $this
     */
    public function update(Request $request, $key)
    {
        $model = $this->getController()->getModel();

        $instance = $model::findOrFail($key);
        $instance->update($request->all());

        // Try to save the models' relationships.
        $this->dispatchRelationships($instance)->save();

        return $this;
    }

    /**
     * Dispatch the relationship data.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $instance
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function dispatchRelationships($instance)
    {
        foreach ($instance->getRelations() as $name => $relation) {
            if ($value = request($name)) {
                $relation = $instance->$name();

                $this->{'set' . class_basename($relation) . 'Relation'}($relation, $value);
            }
        }

        return $instance;
    }

    /**
     * Set a belongsTo relationship.
     *
     * @param  \Illuminate\Database\Eloquent\Relations\Relation  $relationship
     * @param  mixed  $value
     */
    protected function setBelongsToRelation($relationship, $value)
    {
        $relationship->associate($value);
    }
}