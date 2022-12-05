<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Models\User;


use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
 
         'name' => 'required',
         'email' => 'required|email',   
         'password' => 'required',
         'c_password' => 'required|same:password'
 
 
        ]);
 
 
        if ($validator -> fails()) {
              
            return $this->sendError('Error validation', $validator->errors());
        }
 
 
       $input = $request->all();
       $input['password'] = bcrypt($input['password']);
       $user = User::create($input);
       $success['token'] = $user->createToken('MyApp')->accessToken;
       $success['name'] = $user->name;
        

       return $this->sendResponse($success, 'User Created Successfully');
 
     }
}
