<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;

use Illuminate\Support\Facades\Validator;
class commentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Get the authenticated user ID using Sanctum authentication
            $login_user_id = auth('sanctum')->user()->id;
        
            // Validate the incoming request data
            $validator = Validator::make($request->all(), [
                'post_id' => 'required|exists:posts,id',
                'comment' => 'required|string|max:255',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
        
            // Create a new comment using Eloquent's create method
            $comment = comment::create([
                'user_id' => $login_user_id,
                'post_id' => $request->post_id,
                'comment' => $request->comment,
            ]);
            // Optionally, you can return the newly created comment as a response
            return response()->json(['success' => true, 'message' => 'Comment created successfully', 'comment' => $comment], 201);
        
        } catch (QueryException $e) {
            // If there's an issue with the database query, catch the exception
            return response()->json(['error' => 'Database error'], 500);
        } catch (\Exception $e) {
            // Catch any other general exception
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $comments = Comment::where('status', 1)->get();
        return $comment; 
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment=comment::find($id);
        if($comment){
          $comment->delete();
          return "data deleted successfully";
        }
        else{
         return response([
          'The data you are trying to delete does not exist'
         ]);
        }
    }
}
