<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function geToken(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

       // $user = $request->only(['id', 'name', 'email', 'password']);
        // Se o guard do config que encontra-se no config/auth, permanecer we, podes pôr apartir daqui api. como podes faze-lo apartir do guard, onde esta web e substituir pelo api  'defaults' => ['guard' => 'api','passwords' => 'users',]
        // if ($token = !auth('api')->attempt($credentials)) {
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

    /**
     * Comando Factory: php artisan tinker | User::factory()->create() - executar na linha de comando
     *
     * Quando quiser fazer listagem, vai no Headers e configura o Accept - Application/json e na lina por baixo: Authorization - Bearer segue o token perto do Bearer.
     *
     */


     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6',
         ]);

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

