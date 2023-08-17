<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\User;
use App\Models\Room;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Days;
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
                        'is_cancelled'=>$Lecture->is_cancelled,
                        'on_scheduled'=>$Lecture->on_scheduled,
                        'created_at'=>$Lecture->created_at,
                        'updated_at'=>$Lecture->updated_at,
                    ],
                ];
            }
            return response()->json(['data'=>$LectureData]);
        }else{
            return response()->json(['message'=>'Unauthorized']);
            }
            }

    public function specific($id)
            {
                    // Verify the token
            if (Auth::guard('api')->check()) {
                    $Lecture =Lecture::find($id);

                    $user = User::find($Lecture->user_id);
                    $Room = Room::find($Lecture->room_id);
                    $class = Classes::find($Lecture->class_id);
                    $subject = Subject::find($Lecture->subject_id);
                    $day = Days::find($Lecture->day_id);
                    $timing = Time::find($Lecture->timing_id);


                    $response = [
                        'id' => $Lecture->id,
                        'attributes' => [
                            'user' => [
                                'id' => $user->id,
                                'attributes' => [
                                    'name' => $user->name,
                                    'email' => $user->email,
                                    'email_verified_at' => $user->email_verified_at,
                                    'created_at' => $user->created_at,
                                    'updated_at' => $user->updated_at,
                                ],
                            'room' => [
                                 'id' => $Room->id,
                                 'attributes' => [
                                    'title'=>$Room->title,
                                    'office_id'=>$Room->office_id,
                                    'is_lab'=>$Room->is_lab,
                                    'is_Ac'=>$Room->is_Ac,
                                    'created_at'=>$Room->created_at,
                                    'updated_at'=>$Room->updated_at,
                                    ],
                            'class' => [
                                 'id' => $class->id,
                                 'attributes' => [
                                    'title'=>$class->title,
                                    'batch_id'=>$class->batch_id,
                                    'semester_id'=>$class->semester_id,
                                    'subject_id'=>$class->subject_id,
                                    'created_at'=>$class->created_at,
                                    'updated_at'=>$class->updated_at,
                                    ],
                                  ],
                            'subject' => [
                                  'id' => $subject->id,
                                  'attributes' => [
                                    'name' => $subject->name,
                                    'subdepartment_id' => $subject->subdepartment_id,
                                    'credit_hours' => $subject->credit_hours,
                                    'created_at'=> $subject->created_at,
                                    'updated_at'=> $subject->updated_at,
                              ],
                            ],
                            'day' => [
                                'id' => $day->id,
                                'attributes' => [
                                    'name' => $day->name,
                                    'created_at' =>$day->created_at,
                                    'updated_at' =>$day->updated_at,
                            ],
                          ],
                          'time' => [
                            'id' => $timing->id,
                            'attributes' => [
                                'start_at' => $timing->start_at,
                                'end_at' => $timing->end_at,
                                'created_at' =>$timing->created_at,
                                'updated_at' =>$timing->updated_at,
                        ],
                      ],
                        'user_id'=>$Lecture->user_id,
                        'room_id'=>$Lecture->room_id,
                        'class_id'=>$Lecture->class_id,
                        'subject_id'=>$Lecture->subject_id,
                        'day_id'=>$Lecture->day_id,
                        'timing_id'=>$Lecture->timing_id,
                        'is_cancelled'=>$Lecture->is_cancelled,
                        'on_scheduled'=>$Lecture->on_scheduled,
                        'created_at'=>$Lecture->created_at,
                        'updated_at'=>$Lecture->updated_at,
                          ],
                        ],
                    ],
                ];
            // Return the response with all components data
            return response()->json(['data' => $response]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
};


