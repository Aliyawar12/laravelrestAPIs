<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\User;
use App\Models\Room;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\days;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class LectureController extends Controller
{
    public function index(Request $request){
        if (Auth::guard('api')->check()){
            $Lectures = Lecture::all();

            $LectureData = [];

            foreach ($Lectures as $Lecture){
                $LectureData[]= [
                    'id'=>$Lecture->id,
                    'attribute'=> [
                        'user_id'=>$Lecture->user_id,
                        'room_id'=>$Lecture->room_id,
                        'class_id'=>$Lecture->class_id,
                        'subject_id'=>$Lecture->subject_id,
                        'day_id'=>$Lecture->day_id,
                        'timing_id'=>$Lecture->timing_id,
                        'created_at'=>$Lecture->created_at,
                        'updated_at'=>$Lecture->updated_at,
                    ], 
                ];
            }
            return response()->json(['data'=>$ClassData]);
        }else{
            return response()->json(['message'=>'Unauthorized']);
            }
            }
}
