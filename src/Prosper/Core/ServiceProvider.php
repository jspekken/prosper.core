<?php

namespace Prosper\Core;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Database\Models\Project;
use Prosper\Core\Policies\ProjectPolicy;

/**
 * Class ServiceProvider
 * @package Prosper\Core
 */
class ServiceProvider extends Package
{

    /**
     * Register the package configurations.
     * @var array
     */
    protected $config = [
        'prosper.core' => __DIR__ . '/../../config/core.php',
        'prosper.ui'   => __DIR__ . '/../../config/ui.php'
    ];

    /**
     * Register the package view namespaces.
     * @var array
     */
    protected $views = [
        'prosper.core' => __DIR__
    ];

    /**
     * Register the package menu's.
     * @var array
     */
    protected $menus = [
        __DIR__ . '/../../resources/menus/backend.php'
    ];

    /**
     * Register the package policies.
     * @var array
     */
    protected $policies = [
        Project::class => ProjectPolicy::class
    ];

    /**
     * Register the package event listeners.
     * @var array
     */
    protected $events = [
        \Illuminate\Auth\Events\Logout::class => \Prosper\Core\Listeners\Auth\Logout::class
    ];

    /**
     * Boot the package.
     */
    public function bootPackage()
    {
        app('prosper.router')->register(__DIR__ . '/Http/protected_routes.php');

        app('prosper.router')->register(__DIR__ . '/Http/guest_routes.php', [
            'guarded' => false
        ]);
    }

    /**
     * Register the package.
     */
    public function registerPackage()
    {
        // Set the context switch.
        $this->app['prosper.context'] = app('request')->segment(1) === config('prosper.core.uri')
            ? Context::BACKEND
            : Context::FRONTEND;

        $this->registerAliases(config('prosper.core.aliases'));

        require_once __DIR__ . '/helpers.php';
    }
}
