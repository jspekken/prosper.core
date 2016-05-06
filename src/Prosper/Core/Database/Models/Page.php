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

use Prosper\Core\Database\Traits\Revisionable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package Prosper\Core\Database\Models
 */
class Page extends Model
{

    use Revisionable;

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    /**
     * Scope the query by active items.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     */
    public function scopeActivated($query)
    {
        $query->where('is_active', true);
    }

    /**
     * Scope the query by a certain slug.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string  $slug
     */
    public function scopeBySlug($query, $slug)
    {
        $query->where('slug', $slug);
    }
}