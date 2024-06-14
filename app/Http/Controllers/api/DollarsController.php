<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Dollar;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use LDAP\Result;


#{
#    "status": "success",
#    "code": 200,
#    "message": "User retrieved successfully",
#    "data": {
#    }
#  }

class DollarsController extends Controller
{
    public function index() {
        $data = $this->getCheckData(function() { return Dollar::all(); });
        return response()->json($data);
    }
    //Refactoring: Este código debe ir en un archivo utilidades o en un middleware, tengo que evaluarlo
    private function getCheckData(callable $modelQueryFunction){

        $result = ['data'=>null, 'message'=>'no data found', 'status'=>200];
        $data = null;
        try {
            $data = $modelQueryFunction();
        } catch (\Exception $e) {
            $result['message'] = 'Error 500: oops something went wrong';
            $result['status'] = 500;
        }

        if ($data){
            if (isset($data['items']) || empty($data['items'])){    
                return $result;
            }
            else if(!$data){
                return $result;
            }
            $result['data'] = $data;
            $result['message'] = 'data is found';
        }
        return $result;
    }
    
}


