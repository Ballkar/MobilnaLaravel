<?php

namespace App\Http\Controllers\Constants;

use App\Http\Controllers\Controller;

class Roles extends Controller
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;    //TODO: zmienić nazwe na usługodawca
    const ROLE_CLIENT = 3;
}
