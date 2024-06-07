<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Log as FacadesLog;


class UserController extends Controller
{
    /**
     * Show all website users.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show a specific user.
     */

    public function show(string $id)
    {
        return User::with('address')->find($id);
    }

    /**
     * It allows user to create a profile.
     */

    public function store(UserRequest $request, string $id)
    {
        $address = Address::find($id);

        // Validation passed, create and store the user
        $user = new User();
        $user->user_name = $request->input('user_name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->address()->associate($address);
        //$user->company()->associate($company);
        $user->save();

        return $user;
    }

    /**
     * It allows the user to update a profile.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);

        // Validation passed, create and store the user
        $user->update([
            $user->user_name = $request->input('user_name'),
            $user->first_name = $request->input('first_name'),
            $user->last_name = $request->input('last_name'),
            $user->email = $request->input('email'),
            $user->password = $request->input('password'),
            $user->role = $request->input('role')
        ]);

        return $user;
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

    public function showCurrentUser()
    {
        try {
            FacadesLog::debug('showCurrentUSer');
            return auth()->user();
        } catch (Exception $e) {
            return response([

                'Message: ' => 'You need to login.',

            ]);
        }
    }
}
