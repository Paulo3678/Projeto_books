<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use App\Http\Services\ApiRequests;
use App\Http\Controllers\Controller;
use App\Http\Services\MessageGenerator;

class Login extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("logado")) return redirect("/home");

        return view("routes.home.login", []);
    }

    public function verifyUser(Request $request)
    {
        $email = filter_var($request->user_email, FILTER_SANITIZE_EMAIL);
        $senha = filter_var($request->user_password, FILTER_SANITIZE_STRING);

        $token = ApiRequests::postRequest("/users/login", [
            "email" => $email,
            "password" => $senha
        ]);

        if ($token === "Autheticated failed") {
            MessageGenerator::errorMessage($request, "Email ou senha incorretos!!");
            return redirect("/login");
        }

        $token = str_replace('"', '', $token);
        $request->session()->put("api_token_key", $token);

        $userData = JWT::decode($token, new Key("teste", "HS256"));

        $admin = $userData->admin;
        $user_id = intval($userData->id_user);
        $user_email = $userData->email;

        // Cookies do site
        $request->session()->put("logado", true);
        $request->session()->put("admin", $admin);
        $request->session()->put("user_id", $user_id);
        $request->session()->put("user_email", $user_email);

        return redirect("/home");
    }

    public function logout(Request $request)
    {
        if (!$request->session()->has("logado")) {
            return redirect("/home");
        }

        $request->session()->flush();
        return redirect("/home");
    }
}
