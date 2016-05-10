<?php

namespace Prosper\Core\Http\Controllers;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

/**
 * Class AdminController
 * @package Prosper\Core\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * @return Response
     */
    public function index($module)
    {
        return admin($this->getControllerNamespace($module), 'list')
            ->build(['list', 'filters', 'scopes'])
            ->render();
    }

    /**
     * @return Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * @return Response
     */
    public function store()
    {

    }

    /**
     * @return Response
     */
    public function show()
    {

    }

    /**
     * @return Response
     */
    public function edit()
    {

    }

    /**
     * @return Response
     */
    public function update()
    {

    }

    /**
     * @return Response
     */
    public function destroy()
    {

    }

    protected function getControllerNamespace($module)
    {
        return config('prosper.admin.controllers.' . $module);
    }
}