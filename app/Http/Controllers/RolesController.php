<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use App\Models\Permission;
use App\Models\Role;


class RolesController extends Controller
{
    public function index(Request $request)
    {
          // Verify the token
    if (Auth::guard('api')->check()) {
            $Roles= Role::all();
        
            //array 
            $roleData = [];
        
            // Loop 
            foreach ($Roles as $Role) {
                $roleData[] = [
                    'id' => $Role->id,
                    'attributes' => [
                        'name' => $Role->name, 
                        'permission_id' => $Role->permission_id,
                        'created_at' => $Role->updated_at,
                        'updated_at' => $Role->updated_at,
                    ],
                ];
            }
        
            // Return the response with all 
            return response()->json(['data' => $roleData]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    }
    
    public function specific($id)
    {
        // Verify the token
    if (Auth::guard('api')->check()) {
            $Roles = Role::find($id);

            $permission = Permission::find($Roles->permission_id);
                $response = [
                    'id' => $Roles->id,
                    'attributes' => [
                        'permission' => [
                            'id' => $permission->id,
                            'attributes' => [
                                'component_id' => $permission->component_id,
                                'created_at' => $permission->created_at,
                                'updated_at' => $permission->updated_at,
                            ],
                        ],
                        'name' => $Roles->name,
                        'created_at' => $Roles->created_at,
                        'updated_at' => $Roles->updated_at,
                    ],
                
                ];
            // Return the response 
            return response()->json(['data' => $response]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }

}
}


