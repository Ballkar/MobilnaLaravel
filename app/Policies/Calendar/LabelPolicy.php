<?php

namespace App\Policies\Calendar;

use App\Models\User\User;
use App\Models\Calendar\Label;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
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
     * @param Label $label
     * @return mixed
     */
    public function view(User $user, Label $label)
    {
        return $user->id === $label->owner_id;
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
     * @param Label $label
     * @return mixed
     */
    public function update(User $user, Label $label)
    {
        return $user->id === $label->owner_id;
    }

    /**
     * Determine whether the user can delete the work.
     *
     * @param User $user
     * @param Label $label
     * @return mixed
     */
    public function delete(User $user, Label $label)
    {
        return $user->id === $label->owner_id;
    }

    /**
     * Determine whether the user can restore the work.
     *
     * @param User $user
     * @param Label $label
     * @return mixed
     */
    public function restore(User $user, Label $label)
    {
        return $user->id === $label->owner_id;
    }

    /**
     * Determine whether the user can permanently delete the work.
     *
     * @param User $user
     * @param Label $label
     * @return mixed
     */
    public function forceDelete(User $user, Label $label)
    {
        return $user->id === $label->owner_id;
    }
}
