<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class DepartmentController extends Controller
{
    public function index(Request $request)
             { 
              if (Auth::guard('api')->check()) {
                $departments= Departments::all();
            
                //array to store the components
                $departData = [];
            
                // Loop through each component 
                foreach ($departments as $department) {
                    $departData[] = [
                        'id' => $department->id,
                        'attributes' => [
                            'name' => $department->name, 
                            'head_id' => $department->head_id,
                            'created_at' => $department->updated_at,
                            'updated_at' => $department->updated_at,
                        ],
                    ];
                }
            
                // Return the response with all components data
                return response()->json(['data' => $departData]);
            }else{
            return response()->json(['message' => 'Unauthorized'], 401);
        }
             }
    
    public function specific($id)
             {
                 // Verify the token
             if (Auth::guard('api')->check()) {
                     $departments= Departments::find($id);
                         $response = [
                             'id' =>  $departments->id,
                             'attributes' => [
                                 // 'component' => [],
                                 'name' => $departments->name, 
                                 'head_id' => $departments->head_id,
                                 'created_at' => $departments->updated_at,
                                 'updated_at' => $departments->updated_at,
                             ],
                            ];
                         
                        
                     // Return the response with all components data
                     return response()->json(['data' => $response]);
                 }else{
                 return response()->json(['message' => 'Unauthorized'], 401);
             }
}

}

