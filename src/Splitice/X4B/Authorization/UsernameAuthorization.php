<?php

namespace Splitice\X4B\Authorization;

use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Exceptions\ApiAuthorizationException;

class UsernameAuthorization implements IX4BApiAuthorization
{
    private string $email;

    private string $password;

    private bool $logged_in = false;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function perform(IX4BApiClient $api, array &$data): void
    {
        if ($this->logged_in) {
            return;
        }

        $response = $api->execute('User', 'login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if (!is_array($response) || ($response['status'] ?? null) !== 'ok') {
            throw new ApiAuthorizationException('Unable to authenticate against the X4B API.');
        }

        $this->logged_in = true;
    }
}
