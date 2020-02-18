<?php

namespace App\Services\Auth;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Auth\UserProvider;

class JwtGuard implements Guard
{
    use GuardHelpers;

    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (!is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $token = $this->getTokenForRequest();

        if (!empty($token)) {
            $publicKey = file_get_contents('../storage/id_rsa.pub');

            $decoded = JWT::decode($token, $publicKey, array('RS256'));
            
            $user = $this->provider->retrieveById($decoded->id);
        }

        return $this->user = $user;
    }

    /**
     * Get the token for the current request.
     *
     * @return string
     */
    public function getTokenForRequest()
    {
        return $this->request->cookie(Config::get('session.cookie'),);
    }

    /**
     * Validate a user's credentials.
     * 
     * @todo
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        // if (empty($credentials[$this->inputKey])) {
        //     return false;
        // }

        // $credentials = [$this->storageKey => $credentials[$this->inputKey]];

        // if ($this->provider->retrieveByCredentials($credentials)) {
        //     return true;
        // }

        return false;
    }

    /**
     * Set the current request instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }
}
