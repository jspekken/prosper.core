<?php

namespace Prosper\Core\Database\Models;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package Prosper\Core\Database\Models
 */
class User extends Authenticatable
{

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * Password hashing attribute setter.
     *
     * @param  string  $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = app('hash')->make($password);
    }
}