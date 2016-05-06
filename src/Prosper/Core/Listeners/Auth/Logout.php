<?php

namespace Prosper\Core\Listeners\Auth;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Logout
 * @package Prosper\Core
 */
class Logout
{

    /**
     * Handle the logout event.
     */
    public function handle()
    {
        // Forget the prosper.project session key so that the next time the
        // user signs in it will see the springboard project selector again.
        session()->forget('prosper.project');
    }
}