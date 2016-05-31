<?php

namespace Prosper\Core\Http\Routing;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class Controller
 * @package Prosper\Core\Http\Routing
 */
class Controller extends BaseController
{

    use AuthorizesResources;
    use AuthorizesRequests;
    use ValidatesRequests;
    use DispatchesJobs;
}
