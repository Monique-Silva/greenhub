<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;

class RegisteredUserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address.number' => ['required', 'integer', 'max:999999999'],
            'address.road' => ['required', 'string', 'max:255'],
            'address.postal_code' => ['required', 'integer', 'max:9999999'],
            'address.city' => ['required', 'string', 'max:255'],
            'address.country' => ['required', 'string', 'max:255'],
        ]);

        try {

            $address = Address::create([
                'number' => $request->number,
                'road' => $request->road,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'country' => $request->country,
            ]);

            $user = User::create([

                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_name' => $request->user_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address_id' => $address->id,
                'company_id' => $request->company_id,
            ]);

            Auth::login($user);

            return response()->json($user, 201);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
