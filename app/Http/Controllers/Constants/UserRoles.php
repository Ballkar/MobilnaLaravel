<?php

namespace App\Http\Controllers\Constants;

use App\Http\Controllers\Controller;

class UserRoles extends Controller
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;    //TODO: zmienić nazwe na usługodawca
    const ROLE_CLIENT = 3;

    static public function returnAll() {
        return [static::ROLE_ADMIN, static::ROLE_USER, static::ROLE_CLIENT];
    }

    static public function returnSafe() {
        return [static::ROLE_USER, static::ROLE_CLIENT];
    }
}
