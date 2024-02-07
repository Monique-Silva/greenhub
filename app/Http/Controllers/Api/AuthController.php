<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        /* it tests if a user exists */
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
            //dd($user);
            //del all ancient user tokens
            $user->tokens()->delete();

            //create a new user token
            $token = $user->createToken($request->device_name)->plainTextToken;

            return response()->json([
                'Message : ' => 'Logged in',
                'token' => $token,
            ]);
        }
    }

    public function logout(Request $request)
    {
        //del all user tokens
        $request->user->tokens()->delete();

        return response()->json([
            'Message : ' => 'Logged out',
        ]);
    }
}
