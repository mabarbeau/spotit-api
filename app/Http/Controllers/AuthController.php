<?php

namespace App\Http\Controllers;

use App\User;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $request;
    protected $user;

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'service' => ['required', 'string'],
            'token' => ['required', 'string'],
        ]);
    }

    /**
     * Login
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(Request $request)
    {
        $this->validator($request->all())->validate();

        $client = new \Google_Client(['client_id' => Config::get('services.client_id')]);
        $payload = $client->verifyIdToken(request('token'));
        
        if (!$payload) {
            return ['status' => 'error'];
        }
        
        $account = Account::where([
            'account_id' => $payload['sub'],
            'provider' => $request['service'],
        ])->first();

        $user = $account 
            ? $account->user
            : User::where(['email' => $payload['email']])->first();

        $code = $user ? 200 : 201;

        $user = self::updateOrCreateUser(
            $user, 
            [
                'name' => $payload['name'],
                'email' => $payload['email'],
                'picture' => $payload['picture'],
            ]
        );

        if (!$account) {
            $user->accounts()->create([
                'provider' => $request['service'],
                'account_id' => $payload['sub'],
            ]);
        }

        $this->guard()->login($user);

        return new Response($user, $code);
    }

    /**
     * Find or create user
     *
     * @param  String  $email
     * @param  String  $name
     */
    protected static function updateOrCreateUser($user, $data)
    {
        if ($user) {
            $user->update($data);
            return $user;
        }
        return User::create($data);
    }

    public function logout()
    {
        Auth::logout();
    }

}
