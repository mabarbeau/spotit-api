<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
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

        $user = User::where(['email' => $payload['email']])->first();

        if(!$user) {
            $user = User::create([
                'email'=> $payload['email'],
                'name' => $payload['name'],
            ]);
        }

        $token = JWT::encode([
            'id' => $user->id,
            "iss" => URL::to('/'),
            "aud" => $request->header('origin'),
            "iat" => Carbon::now()->timestamp,
        ], env('JWT_SECRET'));

        return response($user)->cookie('jwt', $token, 1440);
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
