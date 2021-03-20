<?php

namespace App\Http\Controllers\Constants;

use App\Http\Controllers\Controller;

class PlanTypes extends Controller
{
    const REMIND = 'REMIND';

    static public function returnAll() {
        return [static::REMIND];
    }
}
