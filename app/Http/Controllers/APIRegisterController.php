<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class APIRegisterController extends Controller
{
    public function register(Request $request) {

       $validator = Validator::make($request -> all(), [

        'name' => 'required',
        'email' => 'required|string|email|max:255|unique:users',   
        'password' => 'required'


       ]);


       if ($validator -> fails()) {
             
           return Response::json($validator->errors());
       }


       User::create([

        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'password' => bcrypt($request->get('password'))

       ]);

                $user = User::first();
                $token = JWTAuth::fromUser($user);

                    return Response::json(compact('token'));

    }
}
