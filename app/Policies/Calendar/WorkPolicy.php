<?php

namespace App\Policies\Calendar;

use App\Models\Calendar\Work;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any works.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the work.
     *
     * @param User $user
     * @param Work $work
     * @return mixed
     */
    public function view(User $user, Work $work)
    {
        return $user->id === $work->owner_id;
    }

    /**
     * Determine whether the user can create works.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the work.
     *
     * @param User $user
     * @param Work $work
     * @return mixed
     */
    public function update(User $user, Work $work)
    {
        return $user->id === $work->owner_id && Carbon::parse($work->start)->gt(Carbon::now());
    }

    /**
     * Determine whether the user can delete the work.
     *
     * @param User $user
     * @param Work $work
     * @return mixed
     */
    public function delete(User $user, Work $work)
    {
        return $user->id === $work->owner_id;
    }

    /**
     * Determine whether the user can restore the work.
     *
     * @param User $user
     * @param Work $work
     * @return mixed
     */
    public function restore(User $user, Work $work)
    {
        return $user->id === $work->owner_id;
    }

    /**
     * Determine whether the user can permanently delete the work.
     *
     * @param User $user
     * @param Work $work
     * @return mixed
     */
    public function forceDelete(User $user, Work $work)
    {
        return $user->id === $work->owner_id;
    }
}
