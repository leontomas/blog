<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Admin;

class AuthenticationController extends Controller{

    public function create(Request $request){
        /* Getting all the validated input from the request. */
        $validated = $request->all();

        $status = 0;

        /* Hashing the password before saving it to the database. */
        $validated['password'] = Hash::make($validated['password']);

        /* Creating a new user with the validated input. */
        $data = User::create($validated);
 
        /* This is a simple way of checking if the data is valid. If the data is valid, the status will
        be 1. If the data is not valid, the status will be 0. */
        if($data) $status = 1;

        return response()->json([
            "status" => $status,
            "data" => $data
        ]);
    }

    public function read(Request $request){
        //get all validated incoming request
        $validated = $request->only(['id']);

        $status = 0;

        //find user
        $data = User::find($validated['id']);

        if($data) $status = 1;

        //return the user details
        return response()->json([
            'data' => $data,
            'status' => $status,
        ]);
    }

    public function login(UserLoginRequest $request){
        $validated = $request->safe()->only(['username', 'password']);

        $author = User::where('username', $validated['username'])->first();

        if ( !$author || !Hash::check($validated['password'], $author->password) ) {

            /* Returning a 401 status code with a message. */
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);

        }
        /* Deleting all the tokens for the user. */
        $author->tokens()->delete();

        /* Creating a token for the user. */
        // $token = $author->createToken('auth_token')->plainTextToken;
        $token = $author->createToken('auth_token')->plainTextToken;
        /* Returning the token to the user. */
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'Bearer',
        ]);
        
    }/* END */

    public function logout(){
        
        /* Deleting all the tokens for the user. */
        auth('sanctum')->user()->tokens()->delete();

       /* return a message that the user is logged out*/
       return response()->json([
        
            'message' => 'user logged out',
            'status' => 1
        
        ]);

    }/* END */

}
