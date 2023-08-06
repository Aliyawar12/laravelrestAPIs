<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use APP\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class OfficeController extends Controller
{
    public function index(Request $request){

        if (auth::guard('api')->check()) {
            $offices = Office::all();

            $officeData = [];

            foreach ($offices as $office){
                $officeData[] = [
                    'id'=>$office->id,
                    'attributes'=>[
                        'title'=>$office->title,
                        'user_id'=>$office->user_id,
                        'created_at'=>$office->created_at,
                        'updated_at'=>$office->updated_at,
                    ],
                ];
            }
                return response()->json(['data' => $officeData]);
        } else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function specific($id)
    {
        // Verify the token
    if (Auth::guard('api')->check()) {
            $Offices = Office::find($id);

            $user = User::find($Offices->user_id);
                $response = [
                    'id' =>  $Offices->id,
                    'attributes' => [
                        'User' => [
                            'id' => $user->id,
                            'attributes' => [
                                'name' => $user->name,
                                'email' => $user->email,
                                'created_at' => $user->created_at,
                                'updated_at' => $user->updated_at,
                            ],
                        ],
                        'title' => $Offices->title,
                        'created_at' =>  $Offices->created_at,
                        'updated_at' =>  $Offices->updated_at,
                    ],
                
                ];
            // Return the response with all components data
            return response()->json(['data' => $response]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}

};
