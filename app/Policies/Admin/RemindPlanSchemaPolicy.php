<?php


namespace App\Policies\Admin;


use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RemindPlanSchemaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user)
    {
        return $user->isAdmin();
    }

}
