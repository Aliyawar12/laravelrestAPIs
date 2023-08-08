<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class SemesterController extends Controller
{
    public function index(){
         if (Auth::guard('api')->check()){
            $semesters = Semester::all();

            $SemesterData = [];

                foreach ($semesters as $Semester){
                    $SemesterData[] = [
                        'id' => $Semester->id,
                            'attributes' => [
                                'title' => $Semester->title,
                                'semester_no' => $Semester->semester_no,
                                'created_at' =>$Semester->created_at,
                                'updated_at' =>$Semester->updated_at,
                                
                            ],

                    ];

                }
            return response()->json(['data' => $SemesterData]);
         } else{
            return response()->json(['message' => 'Unauthorized'], 401);
         }
    }
 
    public function specific($id){
        if (Auth::guard('api')->check()){
        $semesters = Semester::find($id);
                $response= [
                    'id' => $semesters->id,
                        'attributes' => [
                            'title' => $semesters->title,
                            'semester_no' => $semesters->semester_no,
                            'created_at' =>$Semester->created_at,
                            'updated_at' =>$Semester->updated_at,
                        ],

                ];
                  // Return the response with all components data
                  return response()->json(['data' => $response]);
                  
                }else{
                return response()->json(['message' => 'Unauthorized'], 401);
            }

    }
};
