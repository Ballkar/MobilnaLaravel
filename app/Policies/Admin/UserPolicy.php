<?php


namespace App\Policies\Admin;


use App\Models\User\User;

class UserPolicy
{

    /**
     * Determine whether the user can view any works.
     *
     * @param User $loggedUser
     * @return mixed
     */
    public function viewAny(User $loggedUser)
    {
        return $loggedUser->isAdmin();
    }

    /**
     * Determine whether the user can view the work.
     *
     * @param User $loggedUser
     * @param User $user
     * @return mixed
     */
    public function view(User $loggedUser, User $user)
    {
        return $loggedUser->id === $user->id || $loggedUser->isAdmin();
    }

    /**
     * Determine whether the user can create works.
     *
     * @param User $loggedUser
     * @return mixed
     */
    public function create(User $loggedUser)
    {
        return $loggedUser->isAdmin();
    }

    /**
     * Determine whether the user can update the work.
     *
     * @param User $loggedUser
     * @param User $user
     * @return mixed
     */
    public function update(User $loggedUser, User $user)
    {
        return $loggedUser->id === $user->owner_id || $loggedUser->isAdmin();
    }
}
