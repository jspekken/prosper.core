<?php

namespace Prosper\Core\Http\Controllers\Auth;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Http\Requests\Auth\SpringboardRequest;
use Prosper\Core\Database\Models\Project;
use Illuminate\Routing\Controller;

/**
 * Class SpringboardController
 * @package Prosper\Core\Http\Controllers\Auth
 */
class SpringboardController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = app('auth')->user()->projects;

        // When the user does not have previously
        // created projects we need to create one.
        if ($projects->isEmpty()) {
            return redirect()->to(prosper_route('auth.springboard.create'));
        }

        // Just sign into the first project if the user
        // only has one project to choose from.
        if ($projects->count() == 1) {
            return $this->open($projects->first());
        }

        // ... Saul Goodman
        return view('prosper.core::screens.auth.springboard.show')->with([
            'projects' => $projects
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prosper.core::screens.auth.springboard.create');
    }

    /**
     * @param  SpringboardRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SpringboardRequest $request)
    {
        $project = Project::create($request->all());
        $project->users()->save(app('auth')->user());
        $project->save();

        return $this->open($project);
    }

    /**
     * @param  Project  $project
     *
     * @return \Illuminate\Http\Response
     */
    public function open(Project $project)
    {
        session()->put('prosper.project', $project);

        return redirect()->to(config('prosper.core.uri'));
    }
}