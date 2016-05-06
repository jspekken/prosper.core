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

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;

/**
 * Class Package
 * @package Prosper\Core
 */
class Package extends ServiceProvider
{

    /**
     * Holds the Gate instance.
     * @var null|\Illuminate\Contracts\Auth\Access\Gate
     */
    protected $gate = null;

    /**
     * @var array
     */
    protected $commands = [];

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var array
     */
    protected $translations = [];

    /**
     * @var array
     */
    protected $migrations = [];

    /**
     * @var array
     */
    protected $views = [];

    /**
     * @var array
     */
    protected $menus = [];

    /**
     * Security policies
     * @var array
     */
    protected $policies = [];

    /**
     * Event listeners.
     * @var array
     */
    protected $events = [];

    /** {@inheritdoc} */
    public function boot()
    {
        $this->gate = app(Gate::class);

        $this->registerViewNamespaces($this->views);
        $this->registerPolicies($this->policies);
        $this->registerEventListeners($this->events);

        if (method_exists($this, 'bootPackage')) {
            $this->bootPackage();
        }

        $this->registerMenus($this->menus);
    }

    /** {@inheritdoc} */
    public function register()
    {
        $this->mergeConfigFiles($this->config);
        $this->commands($this->commands);

        if (method_exists($this, 'registerPackage')) {
            $this->registerPackage();
        }
    }

    /**
     * Merge a given array of config files.
     *
     * @param  array  $config
     *
     * @return $this
     */
    public function mergeConfigFiles(array $config)
    {
        foreach ($config as $namespace => $path) {
            $this->mergeConfigFile($namespace, $path);
        }

        return $this;
    }

    /**
     * Merge a config file.
     *
     * @param  string  $namespace
     * @param  string  $path
     *
     * @return $this
     */
    public function mergeConfigFile($namespace, $path)
    {
        $this->mergeConfigFrom($path, $namespace);

        return $this;
    }

    public function registerViewNamespaces(array $namespaces)
    {
        foreach ($namespaces as $namespace => $path) {
            $this->registerViewNamespace($namespace, $path);
        }

        return $this;
    }

    public function registerViewNamespace($namespace, $path)
    {
        app('prosper.view')->addNamespace($namespace, $path);

        return $this;
    }

    /**
     * Register an array of aliases.
     *
     * @param  array  $aliases
     *
     * @return $this
     */
    public function registerAliases(array $aliases)
    {
        foreach ($aliases as $alias => $instance) {
            $this->registerAlias($alias, $instance);
        }

        return $this;
    }

    /**
     * Register a specific alias.
     *
     * @param  string  $alias
     * @param  string  $instance
     *
     * @return $this
     */
    public function registerAlias($alias, $instance)
    {
        app()->singleton($alias, function () use ($instance) {
            return new $instance;
        });

        return $this;
    }

    public function registerPolicies(array $policies)
    {
        foreach ($policies as $name => $policy) {
            $this->gate->policy($name, $policy);
        }

        return $this;
    }

    public function registerMenus(array $menus)
    {
        foreach ($menus as $menu) {
            require_once $menu;
        }

        return $this;
    }

    /**
     * Register event listeners.
     *
     * @param  array  $listeners
     *
     * @return $this
     */
    protected function registerEventListeners($listeners)
    {
        foreach ($listeners as $event => $listener) {
            app('events')->listen($event, $listener);
        }

        return $this;
    }
}