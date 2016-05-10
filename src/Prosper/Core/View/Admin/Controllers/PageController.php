<?php

namespace Prosper\Core\View\Admin\Controllers;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\View\Admin\Mappers\Mapper;
use Prosper\Core\View\Admin\Controller;
use Prosper\Core\Database\Models\Page;

/**
 * Class PageController
 * @package Prosper\Core\View\Admin\Controllers
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
        $mapper->add('text', ['name' => 'text']);
    }
}