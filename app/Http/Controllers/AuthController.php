<?php

namespace App\Http\Controllers;

use App\User;
use App\Account;
use Carbon\Carbon;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    protected $request;
    protected $user;

    /**
     * Login
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(Request $request)
    {
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

        $user->load('accounts');

        $token = self::createToken($user, $request);

        return response($user)->cookie(
            Config::get('session.cookie'),
            $token,
            Config::get('session.lifetime'),
            Config::get('session.path'),
            Config::get('session.domain'),
            Config::get('session.secure'),
            Config::get('session.http_only'),
        );
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

    /**
     * Find or create user
     *
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     */
    protected static function createToken(User $user, Request $request) {
        $privateKey = file_get_contents('../storage/id_rsa');

        return JWT::encode([
            'id' => $user->id,
            "iss" => URL::to('/'),
            "aud" => $request->header('origin'),
            "iat" => Carbon::now()->timestamp,
        ], $privateKey, 'RS256');
    }

    public function refresh()
    {
        // Get refresh token
        // Validate refresh token
        // Get user
        // Respond with token
    }

    public function logout()
    {
        // Delete cookie
        // Invalidate token
    }

}
