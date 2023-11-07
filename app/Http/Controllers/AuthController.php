<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends \App\Http\Controllers\API\Controller
{
    public function register()
    {
        User::create(\request()->only('email', 'password', 'name'));
        $token = auth()->attempt(\request(['email', 'password']));
        return response()->json([
            'token' => $token
        ]);
    }


    public function login()
    {
        $token = auth()->attempt(\request(['email', 'password']));
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
            'token' => $token
        ]);
    }

    public function me()
    {
        return response()->json([
            'user' => auth()->user(),
        ]);
    }

}
