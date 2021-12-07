<?php

namespace App\Http\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class TokenFactory
{
    private $token = null;

    public function getToken(Request $request)
    {
        return str_replace('"', "", $request->session()->get("api_token_key"));
    }

    /**
     * @return array
     */
    public function jwtDecode($token)
    {
        $response = JWT::decode($token, new Key("teste", "HS256"));
        return $response;
    }
}
