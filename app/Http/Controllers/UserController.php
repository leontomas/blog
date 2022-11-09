<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller{
    
    public function create(Request $request){
        $validated = $request->safe()->all();

        $status = 0;

        $validated['password'] = Hash::make($validated['password']);

        //create the user with validated input
        $data = User::create($validated);

        if($data) $status = 1;

        return response()->json([
            "status" => $status,
            "data" => $data
        ]);
    }

    public function read(Request $request){
        //get all validated incoming request
        $validated = $request->safe()->only(['id']);

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

    public function update(Request $request, $id){
        //get all validated incoming request
        $validated = $request->safe()->all();
        
        //look for the user based on the id
        $data = User::find($validated['id']);
        
        if($data) $status = 1;
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
        //get all validated incoming request
        $validated = $request->safe()->only(['id']);
        
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
}
