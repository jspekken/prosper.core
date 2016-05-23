<?php

namespace Prosper\Core\Admin\Controllers;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Database\Models\Page;
use Prosper\Core\Admin\Mappers\Mapper;
use Prosper\Core\Admin\Controller;

/**
 * Class PageController
 * @package Prosper\Core\Admin\Controllers
 */
class PageController extends Controller
{

    /**
     * Set the controller model.
     * @var Page
     */
    protected $model = Page::class;

    /**
     * Configure the list view.
     *
     * @param  Mapper  $mapper
     */
    public function configureList(Mapper $mapper)
    {
        $mapper->add('auto-link', [
            'name'   => 'name',
            'label'  => 'Page name',
            'sub-column' => function ($field) {
                return $field->row->slug;
            }
        ]);

        $mapper->add('label', [
            'name'   => 'created_at',
            'label'  => 'Created at',
            'before' => function ($field) {
                return $field->value->diffForHumans();
            }
        ]);
    }

    /**
     * Configure the form view.
     *
     * @param  Mapper  $mapper
     */
    public function configureForm(Mapper $mapper)
    {
        $mapper->add('input.text', [
            'name'     => 'name',
            'label'    => 'The name of the website',
            'validate' => 'required'
        ]);

        $mapper->add('input.text', [
            'name'     => 'slug',
            'validate' => 'required'
        ]);

        $mapper->add('input.checkbox', [
            'name'  => 'is_active',
            'label' => 'Is active?'
        ]);
    }
}