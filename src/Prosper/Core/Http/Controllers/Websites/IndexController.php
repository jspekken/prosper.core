<?php

namespace Prosper\Core\Http\Controllers\Websites;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\View\Entities\Websites\IndexEntity;
use Illuminate\Routing\Controller;

/**
 * Class IndexController
 * @package Prosper\Core\Http\Controllers\Websites
 */
class IndexController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return app('prosper.ui')->make(IndexEntity::class, 'index')
            ->execute()
            ->render();
    }
}