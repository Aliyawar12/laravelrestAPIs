<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function index(Request $request)
    {
          // Verify the token
    if (Auth::guard('api')->check()) {
            $Users = User::all();

            //array to store the components
            $userData = [];

            // Loop through each component
            foreach ($Users as $user) {
                $userData[] = [
                    'id' => $user->id,
                    'attributes' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'roles_id' => $user->roles_id,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ],
                ];
            }

            // Return the response with all components data
            return response()->json(['data' => $userData]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    }

    public function specific($id)
    {
        // Verify the token
    if (Auth::guard('api')->check()){
            $user = User::find($id);
                $response = [
                    'id' => $user->id,
                    'attributes' => [
                        'name'=> $user->name,
                        'email' => $user->email,
                        'roles_id' => $user->roles_id,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        ],
                    ];

            // Return the response with all components data
            return response()->json(['data' => $response]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }

}

public function update($id, Request $request)
{
    // Verify the token
    if (Auth::guard('api')->check()) {
        $user = User::find($id);

        if ($user) {
            // Update user details based on the request
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->roles_id = $request->input('roles_id');

            $user->save();

            $response = [
                'id' => $user->id,
                'attributes' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles_id' => $user->roles_id,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ],
            ];

            // Return the response with updated user data
            return response()->json(['data' => $response]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    } else {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}



}

