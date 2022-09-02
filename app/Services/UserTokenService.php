<?php

namespace App\Services;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class UserTokenService
{
    public static function generate(Authenticatable | null $user) {
        $user->api_token = Str::uuid();
        $user->save();
        return $user->api_token;
    }
}
