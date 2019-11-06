<?php

namespace App\Http\Controllers\Constants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementTypes extends Controller
{
    const PRIVATE_MOBILE = 1;
    const PRIVATE_LOCAL = 2;
    const PRIVATE_BOTH = 3;
    const STUDIO = 4;


    static public function returnAll() {
        return [static::PRIVATE_MOBILE, static::PRIVATE_LOCAL, static::PRIVATE_BOTH, static::STUDIO ];
    }
}
