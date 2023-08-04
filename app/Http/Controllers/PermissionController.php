<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Component;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class PermissionController extends Controller
{
    public function index(Request $request)
    {
          // Verify the token
    if (Auth::guard('api')->check()) {
            $permissions = Permission::all();
            $component = Component::all();
            //array to store the components
            $permissionData = [];
        
            // Loop through each component 
            foreach ($permissions as $permission) {
                $permissionData[] = [
                    'id' => $permission->id,
                    'attributes' => [
                        'component_id' => $permission->component_id,
                        'is_created' => $permission->is_created,
                        'is_updated' => $permission->is_updated,
                        'is_deleted' => $permission->is_deleted,
                        'created_at' => $permission->created_at,
                        'updated_at' => $permission->updated_at,
                    ],
                ];
            }
        
            // Return the response with all components data
            return response()->json(['data' => $permissionData]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    }
    
    public function specific($id)
    {
        // Verify the token
    if (Auth::guard('api')->check()) {
            $permission = Permission::find($id);

            $component = Component::find($permission->component_id);
            //foreach ($permissions as $permission) {
                $response = [
                    'id' => $permission->id,
                    'attributes' => [
                        // 'component' => [],
                        ],
                        'is_created' => $permission->is_created,
                        'is_updated' => $permission->is_updated,
                        'is_deleted' => $permission->is_deleted,
                        'created_at' => $permission->created_at,
                        'updated_at' => $permission->updated_at,
                    ];
                
               
            // Return the response with all components data
            return response()->json(['data' => $response]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }

}
}
