<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTFactory;
use App\Models\User;
use JWTAuth;
use Validator;
use Response;

class APILoginController extends Controller
{
    public function login(Request $request) {

        $validator = Validator::make($request -> all(), [
       
         'email' => 'required|string|email|max:255',   
         'password' => 'required'
 
        ]);

        if ($validator -> fails()) {
              
            return Response::json($validator->errors());
        }

        $credentials = $request->only('email', 'password');
       
        try {
           if (! $token = JWTAuth::attempt($credentials)) {
            
            return Response::json(['error' => 'invalid user name and password'], [401]);
           
        }
        } catch (JWTException $e) {
            
            return Response::json(['error' => 'could not create token'], [500]);
        }

        return response()->json(compact('token'));
     }
}
