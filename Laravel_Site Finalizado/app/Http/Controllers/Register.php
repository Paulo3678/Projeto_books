<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiRequests;
use App\Http\Services\MessageGenerator;
use Illuminate\Http\Request;

class Register
{
    public function index(Request $request)
    {
        if ($request->session()->has("logado")) {
            return redirect("/home");
        }

        return view("routes.home.register");
    }

    public function register(Request $request)
    {
        $userName = $request->user_name;
        $userEmail = $request->user_email;
        $userPassword = $request->user_password;

        $response = ApiRequests::postRequest("/users", [
            "name" => $userName,
            "password" => $userPassword,
            "email" => $userEmail
        ]);

        if ($response === "User already exist") {
            MessageGenerator::errorMessage($request, "Usuário já existe!!");
            return redirect("/register");
        }

        MessageGenerator::successMessage($request, "Usuário cadastrado com sucesso!!");
        return redirect("/login");
    }
}
