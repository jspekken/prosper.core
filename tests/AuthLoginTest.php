<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Prosper\Core\Database\Models\User;

/**
 * Class LoginTest
 */
class AuthLoginTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * Test that we can see the login form.
     */
    public function testSeeLoginForm()
    {
        $this->visit('/backend')
            ->see('password')
            ->see('email')
            ->see('sign-in');
    }

    /**
     * Test that the login fails.
     */
    public function testFailsLogin()
    {
        $this->createUser();

        $this->visit('/backend')
            ->type('test@test.com', 'email')
            ->type('not-awesome', 'password')
            ->press('Sign-in')
            ->seePageIs('/backend/sign-in')
            ->see('These credentials do not match our records.');
    }

    /**
     * Test that we pass the login procedure.
     */
    public function testCanLogin()
    {
        $this->createUser();

        $this->visit('/backend')
            ->type('jspekken@gmail.com', 'email')
            ->type('awesome', 'password')
            ->check('remember_me')
            ->press('Sign-in')
            ->dontSee('These credentials do not match our records.')
            ->seePageIs('/backend');
    }

    /**
     * Create the test user.
     *
     * @return User
     */
    protected function createUser()
    {
        return User::create([
            'name'     => 'Jelle Spekken',
            'email'    => 'jspekken@gmail.com',
            'password' => 'awesome'
        ]);
    }
}