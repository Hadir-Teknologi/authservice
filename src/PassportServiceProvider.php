<?php

namespace Hadirteknologi\Authservice;

use Laravel\Socialite\Two\User;
use Laravel\Socialite\Two\AbstractProvider;

class PassportServiceProvider extends AbstractProvider
{
    protected $scopes = ["openid", "profile", "email"];

    protected function getHadirUrl()
    {
        return config("auth-service.hadirauth.base_uri");
    }

    function getAuthUrl($state)
    {
        $authUri = config("auth-service.hadirauth.auth_uri", '/login/oauth/authorize');
        return $this->buildAuthUrlFromBase($this->getHadirUrl() . $authUri, $state);
    }

    function getTokenUrl()
    {
        $tokenUri = config("auth-service.hadirauth.token_uri", '/api/login/oauth/access_token');
        return $this->getHadirUrl() . $tokenUri;
    }

    function getUserByToken($token)
    {
        $userUri = config("auth-service.hadirauth.user_info_uri", '/api/userinfo');
        $response = $this->getHttpClient()->get($this->getHadirUrl() . $userUri, [
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
