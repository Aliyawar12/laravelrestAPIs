<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Subdepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class BatchController extends Controller
{
    public function index(Request $request){
        
        {
            // Verify the token
      if (Auth::guard('api')->check()) {
              $Batches= Batch::all();
          
              //array 
              $batchData = [];
          
              // Loop  
              foreach ($Batches as $Batch) {
                  $batchData[] = [
                      'id' => $Batch->id,
                      'attributes' => [
                          'session' => $Batch->session, 
                          'start_date' => $Batch->start_date,
                          'end_date' => $Batch->end_date,
                          'subdepartment_id' => $Batch->subdepartment_id,
                          'shift' => $Batch->shift,
                          'created_at' => $Batch->updated_at,
                          'updated_at' => $Batch->updated_at,
                      ],
                  ];
              }
          
              // Return the response 
              return response()->json(['data' => $batchData]);
          }else{
          return response()->json(['message' => 'Unauthorized'], 401);
      }
      }

    }

    public function specific($id)
    {
        // Verify the token
        if (Auth::guard('api')->check()) {
                $Batches =Batch::find($id);

               $subdepartment = Subdepartment::find($Batches->subdepartment_id);
                    $response = [
                        'id' => $Batches->id,
                        'attributes' => [
                            'subdepartments' => [
                                'id' => $subdepartment->id,
                                'attributes' => [
                                     'name' => $subdepartment->name,
                                     'department_id' => $subdepartment->department_id,
                                     'head_id' => $subdepartment->head_id,
                                     'created_at' => $subdepartment->created_at,
                                     'updated_at' => $subdepartment->updated_at,
                                ],
                            ],
                            'session' => $Batches->session, 
                            'start_date' => $Batches->start_date,
                            'end_date' => $Batches->end_date,
                            'subdepartment_id' => $Batches->subdepartment_id,
                            'shift' => $Batches->shift,
                            'created_at' => $Batches->updated_at,
                            'updated_at' => $Batches->updated_at,
                     ],
                 
             ];
            // Return the response with all components data
            return response()->json(['data' => $response]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
}
