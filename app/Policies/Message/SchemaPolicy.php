<?php

namespace App\Policies\Message;

use App\Models\Message\Schema;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchemaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any message schemas.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the message schema.
     *
     * @param User $user
     * @param Schema $schema
     * @return mixed
     */
    public function view(User $user, Schema $schema)
    {
        return $user->id === $schema->owner_id;
    }

    /**
     * Determine whether the user can create message schemas.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the message schema.
     *
     * @param User $user
     * @param Schema $schema
     * @return mixed
     */
    public function update(User $user, Schema $schema)
    {
        return $user->id === $schema->owner_id;
    }

    /**
     * Determine whether the user can delete the message schema.
     *
     * @param User $user
     * @param Schema $schema
     * @return mixed
     */
    public function delete(User $user, Schema $schema)
    {
        return $user->id === $schema->owner_id;
    }

    /**
     * Determine whether the user can restore the message schema.
     *
     * @param User $user
     * @param Schema $schema
     * @return mixed
     */
    public function restore(User $user, Schema $schema)
    {
        return $user->id === $schema->owner_id;
    }

    /**
     * Determine whether the user can permanently delete the message schema.
     *
     * @param User $user
     * @param Schema $schema
     * @return mixed
     */
    public function forceDelete(User $user, Schema $schema)
    {
        return $user->id === $schema->owner_id;
    }
}
