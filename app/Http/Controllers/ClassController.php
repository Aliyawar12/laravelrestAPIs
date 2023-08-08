<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Batch;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class ClassController extends Controller
{
    public function index(Request $request){
        if (Auth::guard('api')->check()){
            $Classes = Classes::all();

            $ClassData = [];

            foreach ($Classes as $Class){
                $ClassData[]= [
                    'id'=>$Class->id,
                    'attribute'=> [
                        'title'=>$Class->title,
                        'batch_id'=>$Class->batch_id,
                        'semester_id'=>$Class->semester_id,
                        'subject_id'=>$Class->subject_id,
                        'created_at'=>$Class->created_at,
                        'updated_at'=>$Class->updated_at,
                    ], 
                ];
            }
            return response()->json(['data'=>$ClassData]);
        }else{
            return response()->json(['message'=>'Unauthorized']);
            }
            }
            public function specific($id)
            {
                    // Verify the token
                if (Auth::guard('api')->check()) {
                    $Class =Classes::find($id);

                    $semester = Semester::find($Class->semester_id);
                    $batch= Batch::find($Class->batch_id);
                    $subject = Subject::find($Class->subject_id);

                    $response = [
                        'id' => $Class->id,
                        'attributes' => [
                            'batch' => [
                                'id' => $batch->id,
                                'attributes' => [
                                    'session' => $batch->session, 
                                    'start_date' => $batch->start_date,
                                    'end_date' => $batch->end_date,
                                    'subdepartment_id' => $batch->subdepartment_id,
                                    'shift' => $batch->shift,
                                    'created_at' => $batch->updated_at,
                                    'updated_at' => $batch->updated_at,
                                ],
                            'semester' => [
                                 'id' => $semester->id,
                                 'attributes' => [
                                     'title' => $semester->title,
                                     'semester_no' => $semester->semester_no,
                                     'created_at' =>$semester->created_at,
                                     'updated_at' =>$semester->updated_at,
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
                                'title'=>$Class->title,
                                'batch_id'=>$Class->batch_id,
                                'semester_id'=>$Class->semester_id,
                                'subject-id'=>$Class->subject_id,
                                'created_at'=>$Class->created_at,
                                'updated_at'=>$Class->updated_at,
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
    }

