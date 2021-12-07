<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class MessageGenerator
{
    public static function errorMessage(Request $request, string $message)
    {
        return $request->session()->flash("error_message", $message);
    }

    public static function successMessage(Request $request, string $message)
    {
        return $request->session()->flash("success_message", $message);
    }
}
