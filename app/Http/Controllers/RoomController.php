<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request){

        if (auth::guard('api')->check()) {
            $Rooms = Room::all();

            $roomData = [];

            foreach ($Rooms as $Room){
                $roomData[] = [
                    'id'=>$Room->id,
                    'attributes'=>[
                        'title'=>$Room->title,
                        'office_id'=>$Room->office_id,
                        'is_lab'=>$Room->is_lab,
                        'is_Ac'=>$Room->is_Ac,
                        'created_at'=>$Room->created_at,
                        'updated_at'=>$Room->updated_at,
                    ],
                ];
            }
                return response()->json(['data' => $roomData]);
        } else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
        public function specific($id)
        {
            // Verify the token
        if (Auth::guard('api')->check()) {
                $Rooms = Room::find($id);
    
                $office = Office::find( $Rooms->office_id);
                    $response = [
                        'id' =>  $Rooms->id,
                        'attributes' => [
                            'Office' => [
                                'id' => $office->id,
                                'attributes' => [
                                    'user_id' => $office->user_id,
                                    'created_at' => $office->created_at,
                                    'updated_at' => $office->updated_at,
                                ],
                            ],
                            'title' => $Rooms->title,
                            'is_lab' => $Rooms->is_lab,
                            'is_Ac' => $Rooms->is_Ac,
                            'created_at' =>  $Rooms->created_at,
                            'updated_at' =>  $Rooms->updated_at,
                        ],
                    
                    ];
                // Return the response with all components data
                return response()->json(['data' => $response]);
            }else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }
}
};
