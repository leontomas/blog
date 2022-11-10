<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserDeleteRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;

class UserController extends Controller{
    
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

    public function list(Request $request){
        $search_columns  = ['first_name', 'last_name', 'username'];
        $limit = ($request->limit) ?  $request->limit : 50;
        $sort_column = ( $request->sort_column) ?  $request->sort_column : 'id';
        $sort_order = ( $request->sort_order) ?  $request->sort_order : 'desc';
        $status = 0;
        $data = new User();
        /* Searching for the value of the request. */
        if(isset($request->search)) {
            $key = $request->search;
            /* Searching for the key in the columns. */
            $data = $data->where(function ($q) use ($search_columns, $key) {
                foreach ($search_columns as $column) {
                    /* Searching for the key in the column. */
                    $q->orWhere($column, 'LIKE', '%'.$key.'%');
                }
            });
        }
        /* Filtering the data by date. */
        if($request->from && $request->to){
            $data = $data->whereBetween('created_at', [
                Carbon::parse($request->from)->format('Y-m-d H:i:s'),
                Carbon::parse($request->to)->format('Y-m-d H:i:s')
                ]);
        }
        $data = $data->orderBy($sort_column, $sort_order)->paginate($limit);
        if($data){
            $status = 1;
            return response()->json([
                    'data' => $data,
                    'status' => $status
                ]);
        } else {
            return response()->json([
                'data' => $data,
                'status' => $status
            ]);
        }
    } /* END */

    public function update(UserUpdateRequest $request){
        //get all validated incoming request
        $validated = $request->all();
        
        //look for the user based on the id
        $data = User::find($validated['id']);
        
        if($data) $status = 1;
        
        /* This is a try catch block. It is used to catch errors and exceptions. */
        try {

            $data->update($validated);

        } catch (\Throwable $th) {

            $status = 0;
        }

        return response()->json([
            'data' => $data,
            'status' => $status
        ]);
    }

    public function delete(Request $request){
        //get all validated incoming request
        $validated = $request->only(['id']);
        
        $status = 0;

        //find the user based on validated value then delete
        $data = User::whereId($validated)->delete();
        
        if($data) $status = 1;
        
        //return a json message
        return response()->json([
            "message" => "User deleted",
            "status" => $status
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
