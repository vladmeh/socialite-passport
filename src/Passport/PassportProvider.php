<?php

namespace Vladmeh\Socialite\Passport;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class PassportProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * @param string $state
     * @return string
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(config('services.passport.api_url') . '/oauth/authorize', $state);
    }

    /**
     * @return string
     */
    protected function getTokenUrl(): string
    {
        return config('services.passport.api_url') . '/oauth/token';
    }

    /**
     * @param string $token
     * @return array|mixed
     * @throws GuzzleException
     */
    protected function getUserByToken($token)
    {
        $userUrl = config('services.passport.api_url') . '/api/user';

        $response = $this->getHttpClient()->get($userUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * @param array $user
     * @return User
     */
    protected function mapUserToObject(array $user): User
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
        ]);
    }

    /**
     * @param string $code
     * @return array
     */
    protected function getTokenFields($code): array
    {
        return [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'redirect_uri' => $this->redirectUrl,
        ];
    }
}
