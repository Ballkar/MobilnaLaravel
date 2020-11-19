<?php

namespace App\Policies\Message;

use App\Models\Message\Plan;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any plans.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the plan.
     *
     * @param User $user
     * @param Plan $plan
     * @return mixed
     */
    public function view(User $user, Plan $plan)
    {
        return $user->id === $plan->owner_id;
    }

    /**
     * Determine whether the user can create plans.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === $plan->owner_id;
    }

    /**
     * Determine whether the user can update the plan.
     *
     * @param User $user
     * @param Plan $plan
     * @return mixed
     */
    public function update(User $user, Plan $plan)
    {
        return $user->id === $plan->owner_id;
    }

    /**
     * Determine whether the user can delete the plan.
     *
     * @param User $user
     * @param Plan $plan
     * @return mixed
     */
    public function delete(User $user, Plan $plan)
    {
        return $user->id === $plan->owner_id;
    }

    /**
     * Determine whether the user can restore the plan.
     *
     * @param User $user
     * @param Plan $plan
     * @return mixed
     */
    public function restore(User $user, Plan $plan)
    {
        return $user->id === $plan->owner_id;
    }

    /**
     * Determine whether the user can permanently delete the plan.
     *
     * @param User $user
     * @param Plan $plan
     * @return mixed
     */
    public function forceDelete(User $user, Plan $plan)
    {
        return $user->id === $plan->owner_id;
    }
}
