<?php

namespace Splitice\X4B\Modules;

class UserApiModule extends Base\ApiModuleClient
{
    /**
     * Describe the API surface for the module.
     *
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function describe(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Authenticate a user with email and password.
     *
     * @param string $email User email.
     * @param string $password User password.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function login(string $email, string $password, array $data = []): mixed
    {
        $data['email'] = $email;
        $data['password'] = $password;

        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Check whether the current session is authenticated.
     *
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function isLoggedIn(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Enable 2FA for the current user.
     *
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function enable_2fa(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented account passkey action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function passkey_register_begin(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented account passkey action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function passkey_register_finish(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented account passkey action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function passkey_auth_options(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented account passkey action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function passkey_auth_begin(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented account passkey action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function passkey_auth_finish(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented account passkey action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function passkey_delete(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented account passkey action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function passkey_update_policy(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'User';
    }
}
