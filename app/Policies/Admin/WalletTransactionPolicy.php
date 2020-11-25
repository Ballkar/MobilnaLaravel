<?php


namespace App\Policies\Admin;


use App\Models\User\User;

class WalletTransactionPolicy
{
    public function create(User $user)
    {
        return $user->isAdmin();
    }
}
