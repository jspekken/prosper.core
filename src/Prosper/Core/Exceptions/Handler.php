<?php

namespace Prosper\Core\Exceptions;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Handler
 * @package Prosper\Core\Exceptions
 */
class Handler extends \Illuminate\Foundation\Exceptions\Handler
{

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(\Exception $e)
    {
        if (config('app.debug')) {
            $status  = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
            $headers = method_exists($e, 'getHeaders') ? $e->getHeaders() : [];

            return response()->make(
                view('prosper.core::errors.' . $status)->with([
                    'exception' => $e
                ]),
                $status,
                $headers
            );
        }

        return parent::convertExceptionToResponse($e);
    }
}
