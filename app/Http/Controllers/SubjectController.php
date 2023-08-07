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
                           ],

                   ];

               }
           return response()->json(['data' => $subjectData]);
        } else{
           return response()->json(['message' => 'Unauthorized'], 401);
        }
   }
}
