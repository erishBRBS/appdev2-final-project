<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    // Existing methods...

    //--------------------------------------GET ALL USERS--------------------------------------//
    public function getAllUsers()
    {
        // Ensure the user is an admin
        if (Auth::user()->role_id !== 2) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Retrieve all users
        $users = UserAccount::all();

        // Return the users as a JSON response
        return response()->json(['users' => $users], 200);
    }

    public function getUserById($id)
    {

        // Retrieve the user by ID
        $user = UserAccount::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Return the user as a JSON response
        return response()->json(['user' => $user], 200);
    }
}
