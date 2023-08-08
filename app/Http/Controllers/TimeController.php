<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class TimeController extends Controller
{
    public function index(){
        if (Auth::guard('api')->check()){
           $timings = Time::all();

           $TimeData = [];

               foreach ($timings as $timing){
                   $TimeData[] = [
                       'id' => $timing->id,
                           'attributes' => [
                               'start_at' => $timing->start_at,
                               'end_at' => $timing->end_at,
                               'created_at' =>$timing->created_at,
                               'updated_at' =>$timing->updated_at, 
                           ],

                   ];

               }
           return response()->json(['data' => $TimeData]);
        } else{
           return response()->json(['message' => 'Unauthorized'], 401);
        }
   }

   public function specific($id){
       if (Auth::guard('api')->check()){
       $timing = Time::find($id);
               $response= [
                   'id' => $timing->id,
                       'attributes' => [
                        'start_at' => $timing->start_at,
                        'end_at' => $timing->end_at,
                        'created_at' =>$timing->created_at,
                        'updated_at' =>$timing->updated_at, 
                       ],

               ];
                 // Return the response with all components data
                 return response()->json(['data' => $response]);
                 
               }else{
               return response()->json(['message' => 'Unauthorized'], 401);
           }

   }
}
