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
use Illuminate\Database\Query\Builder;

/**
 * Class Website
 * @package Prosper\Core\Database\Models
 */
class Website extends Model
{

    use Revisionable;

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'name',
        'domain',
        'is_active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Limit the current query scope to only include the activated websites.
     *
     * @param  Builder  $query
     */
    public function scopeActivated($query)
    {
        $query->where('is_active', true);
    }

    /**
     * Limit the current query scope to only include the given domain.
     *
     * @param   Builder  $query
     * @param   string   $domain
     */
    public function scopeByDomain($query, $domain)
    {
        $query->where('domain', $domain);
    }

    /**
     * Sort the query based on the domain length (shorty's first y'all).
     *
     * @param   Builder  $query
     */
    public function scopeSorted($query)
    {
        $query->orderByRaw('LENGTH(`domain`) DESC');
    }

    /**
     * Get the full url including the protocol and
     * domain to the current given domain.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return sprintf('http%s://%s', request()->isSecure ? 's' : '', trim($this->domain, '/'));
    }
}