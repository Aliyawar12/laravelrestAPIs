<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    //use TwoFactorAuthenticationController;

    public function geToken(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            abort(401, 'Nao Autorizado');
        }
        $user = Auth::user();
        $response = [
            'data' => [
           // {
                "id" => $user->id,
                'attributes' => [
                 //   'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ],
          //  },
                'jwt' => [
                'token' => $token,
                'token_type' => 'bearer'
                ]
            ]
        ];   return response()->json($response);
    }


     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users', // The "unique:users" validation rule ensures email uniqueness
             'password' => 'required|string|min:6',
         ]);

         // Check if the email is already registered
         $existingUser = User::where('email', $request->email)->first();
         if ($existingUser) {
             return response()->json(['message' => 'Email already registered'], 422); // Return a 422 Unprocessable Entity status
         }

         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);

         return response()->json([
             'message' => 'User created successfully',
             'user' => $user
         ]);
     }


     public function logout()
     {
         Auth::logout();
         return response()->json([
             'message' => 'Successfully logged out',
         ]);
     }



}

