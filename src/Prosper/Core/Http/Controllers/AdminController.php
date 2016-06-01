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

use Prosper\Core\Http\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package Prosper\Core\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * @param  string  $module
     *
     * @return Response
     */
    public function index($module)
    {
        return admin($this->getControllerNamespace($module), 'list')
            ->setModule($module)
            ->build(['list', 'filters', 'scopes'])
            ->render();
    }

    /**
     * @param  string  $module
     *
     * @return Response
     */
    public function create($module)
    {
        return admin($this->getControllerNamespace($module), 'form')
            ->setModule($module)
            ->build('form')
            ->render('prosper.core::screens.admin.create');
    }

    /**
     * @param  Request  $request
     * @param  string   $module
     *
     * @return Response
     */
    public function store(Request $request, $module)
    {
        $controller = admin($this->getControllerNamespace($module), 'form')->build('form');

        $this->validateRequest($request, $controller);

        $controller->getBuilder()->store($request);

        return redirect()->to(prosper_route('module.index', $module));
    }

    /**
     * @param  string      $module
     * @param  int|string  $key
     *
     * @return Response
     */
    public function show($module, $key)
    {

    }

    /**
     * @param  string      $module
     * @param  int|string  $key
     *
     * @return Response
     */
    public function edit($module, $key)
    {
        return admin($this->getControllerNamespace($module), 'form')
            ->setModule($module)
            ->build('form', $key)
            ->render('prosper.core::screens.admin.edit');
    }

    /**
     * @param  Request     $request
     * @param  string      $module
     * @param  int|string  $key
     *
     * @return Response
     */
    public function update(Request $request, $module, $key)
    {
        $controller = admin($this->getControllerNamespace($module), 'form')->build('form', $key);

        $this->validateRequest($request, $controller);

        $controller->getBuilder()->update($request, $key);

        return redirect()->to(prosper_route('module.index', $module));
    }

    /**
     * @return Response
     */
    public function destroy()
    {

    }

    /**
     * Get the namespace to the controller set in the config file.
     *
     * @param  string  $module
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function getControllerNamespace($module)
    {
        if (!$instance = config('prosper.admin.controllers')[$module]) {
            throw new \InvalidArgumentException(sprintf('Could not find the `%s` module.', $module));
        }

        return $instance;
    }

    /**
     * Validate the controller against the request.
     *
     * @param  Request                         $request
     * @param  \Prosper\Core\Admin\Controller  $controller
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRequest(Request $request, \Prosper\Core\Admin\Controller $controller)
    {
        $rules = [];

        foreach ($controller->getBuilder()->data->fields as $field) {
            if (isset($field->validate)) {
                $rules[$field->name] = $field->validate;
            }
        }

        $this->validate($request, $rules);
    }
}