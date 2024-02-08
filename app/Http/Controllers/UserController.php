<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show all website users.
     */
    public function index()
    {
        $user = User::all();

        return response()->json([
            'User: ' => $user,
        ]);
    }

    /**
     * Show a specific user.
     */

    public function show(string $id)
    {
        $user = User::find($id);

        if ($user) {

            return response()->json([
                'Message: ' => 'User found.',
                'User: ' => $user,
            ]);
        } else {

            return response([

                'Message: ' => 'The user cannot be found.',

            ]);
        }
    }

    /**
     * It allows user to create a profile.
     */

    public function store(UserRequest $request)
    {
        // Validation passed, create and store the user
        $user = new User();
        $user->user_name = $request->input('user_name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->email_verified_at->$request->input('email_verified_at');
        $user->rememberToken->$request->input('rememberToken');
        $user->role = $request->input('role');
        if ($user->save()) {

            return response()->json([
                'Message: ' => 'A new user was created.',
                'User created: ' => $user
            ]);
        } else {

            return response([
                'Message: ' => 'The new user could not be created.',
            ]);
        }
    }

    /**
     * It allows the user to update a profile.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);

        if ($user) {

            // Validation passed, create and store the user
            $user->update([
                $user->user_name = $request->input('user_name'),
                $user->first_name = $request->input('first_name'),
                $user->last_name = $request->input('last_name'),
                $user->email = $request->input('email'),
                $user->password = $request->input('password'),
                $user->role = $request->input('role')
            ]);
            $user->save();

            if ($user->save()) {

                return response()->json([

                    'Message: ' => 'The profile was updated with success.',
                    'User: ' => $user

                ]);
            } else {

                return response([

                    'Message: ' => 'We could not update the profile.',

                ]);
            }
        } else {

            return response([

                'Message: ' => 'We could not find the user profile.',

            ]);
        }
    }
    /**
     *It allows the user to delete the user, but since we don't want the user to be deleted (mostly out of stock), we can comment this function
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {

            $user->delete();

            return response()->json([

                'Message: ' => 'User deleted with success.',

            ]);
        } else {

            return response([

                'Message: ' => 'We could not find the user.',

            ]);
        }
    }
}
