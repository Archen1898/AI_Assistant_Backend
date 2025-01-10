<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\User;
use Laravel\Passport\PersonalAccessTokenResult;

trait AuthDataTrait
{
    public function getAuthData(User $user): array
    {
        return [
            'user'         => $user,
            'access_token' => $this->createAuthToken($user)->accessToken, //$tokenInstance->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse($this->createAuthToken($user)->token->expires_at)->toDateTimeString()
        ];
    }

    public function createAuthToken(User $user): PersonalAccessTokenResult
    {
        return $user->createToken('authToken');
    }
}
