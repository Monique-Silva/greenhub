<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Show all registered addresses.
     */
    public function index()
    {
        return Address::all();
    }

    /**
     * Show a specific address related to a user.
     */
    public function show(string $id)
    {
        Address::find($id);
    }

    /**
     * Allow user to create an address.
     */
    public function store(AddressRequest $request)
    {
        // Get authenticated user
        $user = Auth::user();

        // Create and store the address
        $address = new Address();
        $address->number = $request->input('number');
        $address->road = $request->input('road');
        $address->postal_code = $request->input('postal_code');
        $address->city = $request->input('city');
        $address->country = $request->input('country');
        $address->save();

        return response()->json($address, 201);
    }

    /**
     * Allow the user to update an address in their profile.
     */
    public function update(AddressRequest $request, string $id)
    {
        $address = Address::find($id);

        if ($address) {
            $address->update([
                'number' => $request->input('number'),
                'road' => $request->input('road'),
                'postal_code' => $request->input('postal_code'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
            ]);

            return response()->json($address);
        } else {
            return response()->json(['message' => 'Address not found.'], 404);
        }
    }

    /**
     * Allow the user to delete their address.
     */
    public function destroy(string $id)
    {
        $address = Address::find($id);

        if ($address) {
            $address->delete();
            return response()->json(['message' => 'Address deleted successfully.']);
        } else {
            return response()->json(['message' => 'Address not found.'], 404);
        }
    }

    public function showCurrentUsersAddress(string $id)
    {
        Auth::user();

        $address = Address::find($id);

        if ($address) {
            return response()->json($address, 200);
        } else {
            return response()->json(['message' => 'Address not found.'], 404);
        }
    }
}
