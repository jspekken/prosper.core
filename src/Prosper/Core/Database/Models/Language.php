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
 * Class Language
 * @package Prosper\Core\Database\Models
 */
class Language extends Model
{

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'name',
        'locale',
        'is_main',
        'is_active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function websites()
    {
        return $this->hasMany(Website::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function pages()
    {
        return $this->hasManyThrough(Page::class, Website::class);
    }
}