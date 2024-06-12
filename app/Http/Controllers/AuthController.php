<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserAccountResource;

class AuthController extends Controller
{
    //Create user
    public function createUser(CreateUserRequest $request)
    {
        $user = UserAccount::create(
            array_merge(
                $request->except('role_id'),
                ['role_id' => 1, 'password' => Hash::make($request->password)]
            )
        );

        return new UserAccountResource($user);
    }
    public function logIn(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful', 
                'user' => $user, 
                'token' => $token], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
