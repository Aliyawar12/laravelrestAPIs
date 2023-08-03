<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 


class ComponentController extends Controller
{

    public function index(Request $request)
    {
          // Verify the token
    if (Auth::guard('api')->check()) {
            $components = Component::all();
        
            //array to store the components
            $componentData = [];
        
            // Loop through each component 
            foreach ($components as $component) {
                $componentData[] = [
                    'id' => $component->id,
                    'attributes' => [
                        'name' => $component->name,
                        'created_at' => $component->created_at,
                        'updated_at' => $component->updated_at,
                    ],
                ];
            }
        
            // Return the response with all components data
            return response()->json(['data' => $componentData]);
        }else{
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    }
     
    public function getComponentById($id){

          $result = $this->specific($id);

          return $result;
    }
    public function specific($id)
    {
        $component = Component::find($id);

        if ($component) {
            return response()->json([
                'id' => $component->id,
                'name' => $component->name,
            ]);
        } else {
            return response()->json(['message' => 'Component not found.'], 404);
        }
    }
}

