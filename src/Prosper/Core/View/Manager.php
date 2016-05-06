<?php

namespace Prosper\Core\View;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Manager
 * @package Prosper\Core\View
 */
class Manager
{

    /**
     * Holds the path to the views directory.
     * @var string
     */
    protected $path = '/../../resources/views';

    /**
     * Get the view path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the view path.
     *
     * @param  string  $path
     *
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Add a new namespace to the global view finder.
     *
     * @param  string  $namespace
     * @param  string  $directory
     *
     * @return $this
     */
    public function addNamespace($namespace, $directory = __DIR__)
    {
        view()->addNamespace($namespace, $this->getViewPaths($namespace, $directory));

        return $this;
    }

    /**
     * Prepend a new namespace to the global view finder.
     *
     * @param  string  $namespace
     * @param  string  $directory
     *
     * @return $this
     */
    public function prependNamespace($namespace, $directory = __DIR__)
    {
        view()->prependNamespace($namespace, $this->getViewPaths($namespace, $directory));

        return $this;
    }

    /**
     * Create an array of paths to a specific view namespace.
     *
     * @param  string  $namespace
     * @param  string  $directory
     *
     * @return array
     */
    protected function getViewPaths($namespace, $directory)
    {
        return [
            resource_path('views/vendor/' . str_replace('.', '/', $namespace)),
            $directory . $this->getPath()
        ];
    }
}