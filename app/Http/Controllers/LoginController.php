<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    
    public function login(Request $request){

        
        // try{

    
            $validateUser = Validator::make($request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
              
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validateUser->errors()
                ],401);
            }

            if(!Auth::guard('web')->attempt($request->only(['username','password']))){
                return response()->json([
                    'status' =>false,
                    'message' => 'Email & Password does not match',
                 
                ],401);
            }

            $user = User::where('username', $request->username)->first();

           session()->regenerate();
            return response()->json([
                'status' => true,
                'message' => 'User Logged in Successfully',
                'data' =>$user
                // 'token' => $user->createToken('API TOKEN')->plainTextToken
            ],200);

        // }catch(\Throwable $th){
            
        //     return response()->json([
        //         'status' =>false,
        //         'message' => $th->getMessage()
        //     ],500);
        // }
      
    }
}
