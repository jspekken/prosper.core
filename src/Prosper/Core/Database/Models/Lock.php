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

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lock
 * @package Prosper\Core\Database\Models
 */
class Lock extends Model
{

    /*
     * Available lock permissions.
     * - ONLY_ME:  the lock can only be removed by the user who created it.
     * - EVERYONE: everyone can unlock this resource.
     */
    const PERMISSION_ONLY_ME  = 'only-me';
    const PERMISSION_EVERYONE = 'everyone';

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'resource_type',
        'resource_id',
        'lock',
        'unlockable_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Boot event handling.
     */
    public static function boot()
    {
        /*
         * Catch the creating event so that we
         * automatically can set the user id
         * when creating a new lock.
         */
        static::creating(function ($model) {
            $model->user_id = app('auth')->user()->id;
        });
    }
}