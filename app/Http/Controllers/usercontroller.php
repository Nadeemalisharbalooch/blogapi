<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\user;

class usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return "yes iam register controller";
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
       
     
        $request->validate([
        'name'=>'required',
        'email'=>'required',
        'password'=>'required|confirmed ',
                ]);
                $user=user::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
                ]);
        // Check if the user was created successfully
        if ($user) {
            // Assuming you have the $user instance representing the authenticated user
        $token = $user->createToken('mytoken')->plainTextToken;

            return response([
                'token' => $token, 
            ], 201);
        } else {
            return response(['error' => 'User not created'], 500);
        }
        return "yes all completely reach me";
    }
    
    public function login(request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            
        ]);
    
    $user=user::where('email',$request->email)->first();
    if(!$user || !Hash::check($request->password,$user->password)){
        return response([
         'message'=>'the provided creadentials are incorrect.'
        ],401);
    }
    else{
        $token = $user->createToken('mytoken')->plainTextToken;
    
        return response([
            'token' => $token,
        ], 201);
    }
    
    }

    public function logout(){
        auth()->user()->tokens()->delete();
       return "suceesfully logout";
    
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return user::all();
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
    public function update(Request $request , string $id)
    {
    
        $rowsAffected = DB::table('users')
            ->where('id', $id)
            ->update([
             'name' =>$request->name,
        ]);  
        if ($rowsAffected === 0) {
        return "Record not found"; // Handle the case when the record with the given $id is not found.
        }
        return "Data has been successfully updated";
            }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        $user=user::find($id);
      if($user){
        $user->delete();
        return "data deleted successfully";
      }
      else{
       return response([
        'The data you are trying to delete does not exist'
       ]);
      }
    }

}
