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

use Prosper\Core\Database\Models\Lock;

/**
 * Class Lockable
 * @package Prosper\Core\Database\Traits
 */
trait Lockable
{

    /**
     * Lock this resource.
     *
     * @return $this
     */
    public function lock($permission)
    {
        Lock::create($this->getLockParams() + ['unlockable_by' => $permission]);

        return $this;
    }

    /**
     * Unlock this resource.
     *
     * @return $this
     */
    public function unlock()
    {
        $this->getLockableResource()->delete();

        return $this;
    }

    /**
     * Is this resource locked?
     *
     * @return bool
     */
    public function isLocked()
    {
        return (bool) $this->getLockableResource();
    }

    /**
     * Return the user that locked this resource.
     *
     * @return \App\User
     */
    public function lockedBy()
    {
        return $this->getLockableResource()->user();
    }

    /**
     * Can this resource be unlocked?
     *
     * @return bool
     */
    public function isUnlockable()
    {
        $resource = $this->getLockableResource();

        // Is this resource unlockable for everyone or just the current authenticated user?
        return ($resource->unlockable_by === 'everyone'
            || ($resource->unlockable_by === 'only-me' && $this->lockedBy()->getKey() == app('auth')->user()->id));
    }

    /**
     * Prepare the locakable parameters for query usage.
     *
     * @return array
     */
    private function getLockParams()
    {
        return [
            'resource_type' => get_class($this),
            'resource_id'   => $this->getKey()
        ];
    }

    /**
     * Get the locked resource.
     *
     * @return Lock
     */
    private function getLockableResource()
    {
        return Lock::where($this->getLockParams())->first();
    }
}