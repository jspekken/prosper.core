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

/**
 * Class DashboardController
 * @package Prosper\Core\Http\Controllers
 */
class DashboardController extends Controller
{

    /**
     * Render the dashboard view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('prosper.core::screens.dashboard');
    }
}