<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Subdepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class SubjectController extends Controller
{
    public function index(){
        if (Auth::guard('api')->check()){
           $subjects = Subject::all();

           $subjectData = [];

               foreach ($subjects as $subject){
                   $subjectData[] = [
                       'id' => $subject->id,
                           'attributes' => [
                               'name' => $subject->name,
                               'subdepartment_id' => $subject->subdepartment_id,
                               'credit_hours' => $subject->credit_hours,
                               'created_at'=> $subject->created_at,
                               'updated_at'=> $subject->updated_at,
                           ],
                   ];
               }
           return response()->json(['data' => $subjectData]);
        } else{
           return response()->json(['message' => 'Unauthorized'], 401);
        }
   }

            public function specific($id)
            {
                // Verify the token
            if (Auth::guard('api')->check()) {
                    $subject = Subject::find($id);

                    $subdepartment = Subdepartment::find($subject->subdepartment_id);
                        $response = [
                            'id' => $subject->id,
                            'attributes' => [
                                    'subdepartments' => [
                                        'id' => $subdepartment->id,
                                        'attributes' => [
                                            'name' => $subdepartment->name,
                                            'head_id' => $subdepartment->head_id, 
                                            'department_id' => $subdepartment->department_id,
                                            'created_at'=> $subdepartment->created_at,
                                            'updated_at'=> $subdepartment ->updated_at,
                                        ],
                                    ],    
                                        'name' => $subject->name,
                                        'subdepartment_id' => $subject->subdepartment_id,
                                        'credit_hours' => $subject->credit_hours,
                                        'created_at'=> $subject->created_at,
                                        'updated_at'=> $subject ->updated_at,
                                ],
                            
                        ];
                    // Return the response with all components data
                    return response()->json(['data' => $response]);
                }else{
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            }
}
