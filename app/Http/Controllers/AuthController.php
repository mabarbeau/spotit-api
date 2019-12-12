<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
        $client = new \Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken(request('token'));
        
        if (!$payload) {
            return ['status' => 'error'];
        }

        $user = self::findOrCreateUser($payload['email'], $payload['name']);

        $token = self::createToken($user, $request);

        return response($user)->cookie('JSESSIONID', $token, 1440);
    }

    /**
     * Find or create user
     *
     * @param  String  $email
     * @param  String  $name
     */
    protected static function findOrCreateUser($email, $name) {
        $user = User::where(['email' => $email])->first();
        return $user ?? User::create([
            'email' => $email,
            'name' => $name,
        ]);
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
