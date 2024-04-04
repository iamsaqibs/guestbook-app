<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function whoami(Request $request)
    {
        if ($request->user() === null)
            return response("Not logged in", 401);

        return $request->user();
    }

    function logout()
    {
        return Auth::logout();
    }

    function login(Request $request)
    {
        $authBody = $request->only('email', 'password');

        if (Auth::attempt($authBody)) {
            return response("Authenticated as {$request->user()->email}");
        }

        return response("Invalid credentials: {$authBody['email']} / {$authBody['password']}", 401);
    }

}