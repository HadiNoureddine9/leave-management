<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            // Issue the token
            $token = $user->createToken('YourAppName')->plainTextToken;

            return response()->json([
                'message' => 'Logged in successfully!',
                'token' => $token,
            ]);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
