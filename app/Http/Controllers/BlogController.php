<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Blog;

class BlogController extends Controller{
    
    public function create(Request $request)
    {
        /* A method that I created in the `Request` class. It is used to validate the request. */
		$validated = $request->safe()->all();
        /* Used to check if the request was successful or not. */
         $status = 0;
         //Checking if the income has image
         if($request->hasFile('images')){
             $file = $request->file('image');
             $filename =  Str::random(15) . time() . '.' . $file->getClientOriginalExtension();
             $file-> move(public_path('public/Image'), $filename);
             $filename;
         }
 
         /* Adding the image and seller_id to the validated array. */
         // $validated["images"] = $filename;
         $validated["seller_id"] = auth()->user()->id;
         /* Creating a new product. */
         
         $data = Blog::create($validated);
           
         if($data){
             $status = 1;
         }
         return response()->json([
             'data' => $data,
             'status' => $status
         ]);
    }

    public function read(Request $request){
        /* Validating the request. */
		$validated = $request->safe()->only(["id"]);
		/* Used to check if the request was successful or not. */
		$status = 0;
		/* Getting the product based on the ID requested. */
        $data = Blog::find($validated['id']);

		if($data) $status = 1;
		return response()->json([
			"data" => $data,
			"status" => $status
		]);
    }

    public function list(Request $request){
        /* Validating the request. */
		$validated = $request->safe()->only(["id"]);
		/* Used to check if the request was successful or not. */
		$status = 0;
		/* Getting the product based on the ID requested. */
        $data = Blog::find($validated['id']);

		if($data) $status = 1;
		return response()->json([
			"data" => $data,
			"status" => $status
		]);
    }

    public function update(Request $request, $id){
        /* A method that I created in the `Request` class. It is used to validate the request. */
        $validated = $request->safe()->all();
		/* Used to check if the request was successful or not. */
        $status = 0;
		/* Updating the product based on the ID requested. */
		$data = Blog::find($validated['id']);
		$data->update($validated);
		/* Checking if the data is available or not. If it is available, it will return the data and a status of 1. If it is not available, it will return a message and a status of 0. */
		if($data) $status = 1;
		return response()->json([
			'data' => $data,
			'status' => $status
		]);
    }

    public function delete(Request $request, $id){
        /* Validating the request. */
        $validated = $request->safe()->only(['id']);
		/* Used to check if the request was successful or not. */
        $status = 0;
        /* Deleting the product based on the ID requested. */
        $data = Blog::whereId($validated['id'])->delete();

		// If no product found
		if($data) $status = 1;

        return response()->json([
            "status" => $status
        ]);
    }
}
