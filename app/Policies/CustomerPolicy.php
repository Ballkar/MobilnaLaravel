<?php

namespace App\Policies;

use App\Models\Announcement\Customer;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any customers.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param User $user
     * @param Customer $customer
     * @return mixed
     */
    public function view(User $user, Customer $customer)
    {
        return $user->id === $customer->owner_id;
    }

    /**
     * Determine whether the user can create customers.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the customer.
     *
     * @param User $user
     * @param Customer $customer
     * @return mixed
     */
    public function update(User $user, Customer $customer)
    {
        return $user->id === $customer->owner_id;
    }

    /**
     * Determine whether the user can delete the customer.
     *
     * @param User $user
     * @param Customer $customer
     * @return mixed
     */
    public function delete(User $user, Customer $customer)
    {
        return $user->id === $customer->owner_id;
    }

    /**
     * Determine whether the user can restore the customer.
     *
     * @param User $user
     * @param Customer $customer
     * @return mixed
     */
    public function restore(User $user, Customer $customer)
    {
        return $user->id === $customer->owner_id;
    }

    /**
     * Determine whether the user can permanently delete the customer.
     *
     * @param User $user
     * @param Customer $customer
     * @return mixed
     */
    public function forceDelete(User $user, Customer $customer)
    {
        return $user->id === $customer->owner_id;
    }
}
