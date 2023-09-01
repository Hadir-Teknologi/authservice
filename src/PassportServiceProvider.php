<?php

namespace Hadirteknologi\Authservice;

use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;

class PassportServiceProvider extends AbstractProvider
{
    protected $scopes = ["openid", "profile", "email"];

    protected function getHadirUrl()
    {
        return config("services.hadirauth.base_uri");
    }

    function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->getHadirUrl() . "/login/oauth/authorize", $state);
    }

    function getTokenUrl()
    {
        return $this->getHadirUrl() . "/api/login/oauth/access_token";
    }

    function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->getHadirUrl() . '/api/userinfo', [
            'headers' => [
                'cache-control' => 'no-cache',
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['sub'],
            'email' => $user['email'],
            'username' => $user['preferred_username'],
            'email_verified' => true,
            'family_name' => $user['name'],
        ]);
    }
}
