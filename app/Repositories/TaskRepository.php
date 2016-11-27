<?php
/**
 * Created by PhpStorm.
 * User: yimeng
 * Date: 16-11-27
 * Time: 下午11:07
 */

namespace App\Repositories;

use App\Models\User;


class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
