<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Days;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class DaysController extends Controller
{
    public function index(){
        if (Auth::guard('api')->check()){
           $days = Days::all();

           $DaysData = [];

               foreach ($days as $day){
                   $DaysData[] = [
                       'id' => $day->id,
                           'attributes' => [
                               'name' => $day->name,
                               'created_at' =>$day->created_at,
                               'updated_at' =>$day->updated_at, 
                           ],

                   ];

               }
           return response()->json(['data' => $DaysData]);
        } else{
           return response()->json(['message' => 'Unauthorized'], 401);
        }
   }

   public function specific($id){
       if (Auth::guard('api')->check()){
       $day = Days::find($id);
               $response= [
                   'id' => $day->id,
                       'attributes' => [
                           'name' => $day->name,
                           'created_at' =>$day->created_at,
                           'updated_at' =>$day->updated_at,
                       ],

               ];
                 // Return the response with all components data
                 return response()->json(['data' => $response]);
                 
               }else{
               return response()->json(['message' => 'Unauthorized'], 401);
           }

   }
}
