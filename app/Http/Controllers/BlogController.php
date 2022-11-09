<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCreateRequest;
use App\Http\Requests\BlogDeleteRequest;
use App\Http\Requests\BlogReadRequest;
use App\Http\Requests\BlogUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use App\Models\Blog;

class BlogController extends Controller{
    
    public function create(BlogCreateRequest $request)
    {
		$validated = $request->all();

        $status = 0;
 
        $data = Blog::create($validated);
           
        if($data) $status = 1;
        return response()->json([
            'data' => $data,
            'status' => $status
        ]);
    }

    public function read(BlogReadRequest $request){

        $validated = $request->only(["id"]);

		$status = 0;

        $data = Blog::find($validated['id']);
        
		if($data) $status = 1;
		return response()->json([
			"data" => $data,
			"status" => $status
		]);
    }

    public function list(Request $request){
        $search_columns  = ['name', 'type'];
        $limit = ($request->limit) ?  $request->limit : 50;
        $sort_column = ( $request->sort_column) ?  $request->sort_column : 'id';
        $sort_order = ( $request->sort_order) ?  $request->sort_order : 'desc';
        $status = 0;
        $data = new Blog();
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

    public function update(BlogUpdateRequest $request){

        $validated = $request->safe()->all();

        $status = 0;

		$data = Blog::find($validated['id']);

		$data->update($validated);

		if($data) $status = 1;
		return response()->json([
			'data' => $data,
			'status' => $status
		]);
    }

    public function delete(BlogDeleteRequest $request){
        $validated = $request->safe()->only(['id']);

        $status = 0;

        $data = Blog::whereId($validated['id'])->delete();

		if($data) $status = 1;

        return response()->json([
            "status" => $status
        ]);
    }
}
