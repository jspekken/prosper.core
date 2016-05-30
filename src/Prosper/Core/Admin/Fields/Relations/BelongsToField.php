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
        $this->value = $this->row->{$this->name};

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
        $options = $this->value->get()->lists($this->display, $this->value->getKeyName());

        return (new SelectField($this->mapper))
            ->setProperties($this->properties + ['options' => $options])
            ->render();
    }
}