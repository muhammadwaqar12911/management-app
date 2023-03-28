<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'username'=>'required|max:255',
            'password'=>'required|max:255',
        ]);
        if($validator->fails()){
            $errors=array('error'=>$validator->errors());
            return response()->json($errors,202);
        }
        
        if(! $user = User::where('email', $request->username)->where('password', $request->password)->first())
        {
            if(! $user = User::where('phone', $request->username)->where('password', $request->password)->first()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Login credentials are invalid',
                ], 202);
            }
        }

        return response()->json([
            'status' => true,
            'data'=>$user,
            'message' => 'Login Successful',
        ]);
    }
}
