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

        return view('prosper.core::screens.auth.springboard.show')->with([
            'projects' => $projects
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function open(Project $project)
    {
        session()->put('prosper.project', $project);

        return redirect()->to(config('prosper.core.uri'));
    }
}