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

use Prosper\Core\Http\Requests\Auth\SessionRequest;
use Illuminate\Routing\Controller;

/**
 * Class SessionsController
 * @package Prosper\Core\Http\Controllers\Auth
 */
class SessionsController extends Controller
{

    /**
     * Show the for for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prosper.core::screens.auth.sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SessionRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SessionRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (app('auth')->attempt($credentials, $request->get('remember_me'))) {
            return redirect()->intended(config('prosper.core.uri'));
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        app('auth')->logout();

        return redirect()->to(config('prosper.core.uri'));
    }
}