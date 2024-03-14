<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        // Retrieve the user based on the provided email
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Attempt authentication with the provided credentials
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::user();

            // Revoke existing tokens
            $user->tokens()->delete();

            // Generate a new access token
            $token = $user->createToken('authToken')->accessToken;

            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


}
