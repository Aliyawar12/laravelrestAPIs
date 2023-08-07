<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdepartment;
use App\Models\Departments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 


class SubdepartmentController extends Controller
{
    public function index(Request $request){
        {
            if(auth::guard('api')->check()) {
                $subdepartments = Subdepartment::all();

                $subdepart = [];

                foreach ($subdepartments as $subdepartment) {
                    $subdepart[] = [
                        'id' => $subdepartment->id,
                        'attributes' => [
                            'name' => $subdepartment->name,
                            'head_id' => $subdepartment->head_id, 
                            'department_id' => $subdepartment->department_id,
                            'created_at'=> $subdepartment->created_at,
                            'updated_at'=> $subdepartment ->updated_at,
                        ],

                    ];
                }
                    return response()->json(['data' => $subdepart]);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        } 
    }
       }

       public function specific($id)
       {
           // Verify the token
       if (Auth::guard('api')->check()) {
               $subdepartment = Subdepartment::find($id);
   
               $department = Departments::find($subdepartment->department_id);
                   $response = [
                       'id' => $subdepartment->id,
                       'attributes' => [
                            'departments' => [
                                'id' => $department->id,
                                'attributes' => [
                                    'name' => $department->name,
                                    'head_id' => $department->head_id,
                                    'created_at' => $department->created_at,
                                    'updated_at' => $department->updated_at,
                                 ],
                            ],
                                    'name' => $subdepartment->name,
                                    'head_id' => $subdepartment->head_id,
                                    'department_id' => $subdepartment->department_id,
                                    'created_at' => $subdepartment->created_at,
                                    'updated_at' => $subdepartment->updated_at,
                        ],
                    
                ];
               // Return the response with all components data
               return response()->json(['data' => $response]);
           }else{
           return response()->json(['message' => 'Unauthorized'], 401);
       }
}
};

