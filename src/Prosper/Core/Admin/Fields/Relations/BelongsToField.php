<?php

namespace Prosper\Core\Admin\Fields\Relations;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Admin\Fields\Input\SelectField;
use Prosper\Core\Admin\Fields\Field;

/**
 * Class BelongsToField
 * @package Prosper\Core\Admin\Fields\Relations
 */
class BelongsToField extends Field
{

    /** {@inheritdoc} */
    public function render()
    {
        // Set the field value.
        $this->value = $this->row
            ? $this->row->{$this->name}
            : null;

        if ($this->context == Field::CONTEXT_LIST) {
            return $this->renderList();
        }

        return $this->renderForm();
    }

    /**
     * Render the list view.
     *
     * @return string
     */
    protected function renderList()
    {
        return $this->value->{$this->display};
    }

    /**
     * Render the form view.
     *
     * @return string
     */
    protected function renderForm()
    {
        return (new SelectField($this->mapper))
            ->setProperties($this->properties + [
                'options'  => $this->getOptions(),
                'selected' => $this->selected
            ])
            ->render();
    }

    /**
     * Get the field options.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getOptions()
    {
        // Do we have a value we can get the selected relation from?
        if ($value = $this->value) {
            $this->selected = $value->getKey();

            return $value->get()->lists($this->display, $value->getKeyName());
        }

        // We don't have a previously set value so let's try to
        // query all the entries from our related model.
        $model = $this->getMapper()->getController()->getModel();
        $instance = new $model;

        return $instance->{$this->name}()
            ->getRelated()
            ->get()
            ->lists($this->display, $instance->getKeyName());
    }
}