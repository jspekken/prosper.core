<?php

namespace Prosper\Core\Policies;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Prosper\Core\Database\Models\Project;
use Prosper\Core\Database\Models\User;

/**
 * Class ProjectPolicy
 * @package Prosper\Core\Policies
 */
class ProjectPolicy
{

    /**
     * Check that the given user has access to a certain project.
     *
     * @param  User     $user
     * @param  Project  $project
     *
     * @return boolean
     */
    public function access(User $user, Project $project)
    {
        return $user->projects->contains($project->id);
    }
}