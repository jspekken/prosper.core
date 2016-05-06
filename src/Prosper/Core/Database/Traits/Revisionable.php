<?php

namespace Prosper\Core\Database\Traits;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Database\Models\Revision;

/**
 * Class Revisionable
 * @package Prosper\Core\Database\Traits
 */
trait Revisionable
{

    /**
     * Log a new revision for this model.
     *
     * @param  string  $event
     */
    public function logRevision($event)
    {
        $revision = new Revision([
            'subject_id'   => $this->getKey(),
            'subject_type' => get_class($this),
            'event'        => $event
        ]);

        $revision->user()->associate(app('auth')->user()->getKey());
        $revision->save();
    }

    /**
     * Get the model events to record activity for.
     *
     * @return array
     */
    protected static function getRevisionEvents()
    {
        if (isset(static::$revisionEvents)) {
            return static::$revisionEvents;
        }

        return ['created', 'deleted', 'updated'];
    }

    /**
     * Register the used event listeners.
     */
    protected static function bootRevisionable()
    {
        foreach (static::getRevisionEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->logRevision($event);
            });
        }
    }
}