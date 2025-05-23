<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $credentials = $request->validated();

            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
            ]);

            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'user_data' => $user,
                'message' => 'success',
                'auth_token' => $token,
            ], 201); // 201 for resource creation

        } catch (\Exception $e) {
            Log::error('Error while registering: ' . $e->getMessage());
            return response()->json([
                'error' => 'Registration failed',
                'message' => 'Error happened' . ' ' . $e->getMessage(),
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            if (Auth::attempt($credentials)) {
                $user = User::where('email', $credentials['email'])->first();
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'user_data' => $user,
                    'message' => 'success',
                    'auth_token' => $token,
                ], 200);
            }

            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Invalid email or password.',
            ], 401);

        } catch (\Exception $e) {
            Log::error('Error while logging in: ' . $e->getMessage());
            return response()->json([
                'error' => 'Login failed',
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }
}