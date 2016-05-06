<?php

namespace Prosper\Core\Http;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Database\Models\Website;
use Prosper\Core\Context;

/**
 * Class Router
 * @package Prosper\Core\Http\Router
 */
class Router
{

    /**
     * @var null|\Prosper\Core\Database\Models\Website
     */
    protected $website = null;

    /**
     * @var null|\Prosper\Core\Database\Models\Language
     */
    protected $language = null;

    /**
     * @var null|\Prosper\Core\Database\Models\Page
     */
    protected $page = null;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        // Only do the discovery of websites, languages and pages whilst
        // on the frontend context and running in a browser.
        if (app('prosper.context') == Context::FRONTEND && !app()->runningInConsole()) {
            try {
                $this
                    ->discoverWebsite()
                    ->discoverLanguage()
                    ->discoverPage();
            } catch (\Exception $e) {
                // Try it all, catch nothing...
                // (I know, I know)
            }
        }
    }

    /**
     * Append new routes to the framework.
     * These can either come from a file or a closure.
     *
     * @param  string|callable  $routes
     * @param  array            $arguments
     *
     * @return $this
     */
    public function register($routes, array $arguments = [])
    {
        $defaults = [
            'with-prefix' => true,
            'guarded'     => true
        ];

        $arguments  = $arguments + $defaults;
        $parameters = [];

        if ($arguments['with-prefix'] === true) {
            $parameters['prefix'] = config('prosper.core.uri');
        }

        $parameters['middleware'] = array_merge(['web'], config('prosper.core.middleware')['web']);

        if ($arguments['guarded'] === true && ($auth = config('prosper.core.auth'))) {
            $parameters['middleware'][] = $auth;
        }

        app('router')->group($parameters, function () use ($routes) {
            if (!is_callable($routes)) {
                require $routes;

                return;
            }

            $routes();
        });

        return $this;
    }

    /**
     * Discover the current website.
     *
     * @return $this
     */
    protected function discoverWebsite()
    {
        $url = $this->getStrippedUrl();

        try {
            // First try to find exact matches.
            $this->website = Website::activated()
                ->byDomain($url)
                ->sorted()
                ->firstOrFail();
        } catch (\RuntimeException $e) {
            // When we're unable to find the exact matches we'll try to figure out the best match.
            // This is done by sorting all the domains by length (sortest first) and looping
            // through those results untill we find the new `exact` match. This will be our
            // current domain. Nothing is returned when nothing is found.
            $sites = Website::activated()->sorted()->get();

            foreach ($sites as $site) {
                if ((bool) strstr(str_finish($url, '/'), str_finish($site->domain, '/')) === true) {
                    $this->website = $site;
                    break;
                }
            }
        }

        return $this;
    }

    /**
     * Discover the current language.
     *
     * @return $this
     */
    protected function discoverLanguage()
    {
        $this->language = $this->website->language;

        return $this;
    }

    /**
     * Discover the current page.
     *
     * @return $this
     */
    protected function discoverPage()
    {
        $this->page = $this->website->pages()
            ->activated()
            ->bySlug($this->getSlug())
            ->firstOrFail();

        return $this;
    }

    /**
     * Get the stripped url from the request (without the protocol).
     *
     * @return string
     */
    protected function getStrippedUrl()
    {
        return str_replace(parse_url($url = app('request')->url(), PHP_URL_SCHEME) . '://', '', $url);
    }

    /**
     * Get the current slug (url minus the domain).
     *
     * @return string
     */
    protected function getSlug()
    {
        return trim(str_replace($this->website->domain, '', $this->getStrippedUrl()), '/') ?: '/';
    }
}