      <?php

      use Illuminate\Http\Request;
      use Illuminate\Support\Facades\Route;
      use App\Http\Controllers\usercontroller;
      use App\Http\Controllers\Postcontroller;
      use App\Http\Controllers\commentcontroller;

      /*
      |--------------------------------------------------------------------------
      | API Routes
      |--------------------------------------------------------------------------
      |
      | Here is where you can register API routes for your application. These
      | routes are loaded by the RouteServiceProvider and all of them will
      | be assigned to the "api" middleware group. Make something great!
      |
      */

      Route::post('register',[usercontroller::class,'store']);
      Route::post('login',[usercontroller::class,'login']);

      // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
      //     return $request->user();
      // });
      //    user controller
          
      Route::middleware('auth:sanctum')->delete('logout',[usercontroller::class,'logout']);
      Route::middleware('auth:sanctum')->delete('delete/{id}',[usercontroller::class,'destroy']);
      Route::middleware('auth:sanctum')->get('show',[usercontroller::class,'show']);
      Route::middleware('auth:sanctum')->put('update/{id}',[usercontroller::class,'update']);

        //    post controller 

        Route::post('post',[Postcontroller::class,'store']);  
        Route::delete('deletepost/{id}',[Postcontroller::class,'destroy']);  
        Route::get('showpost',[Postcontroller::class,'show']);  
        Route::post('update/{id}',[Postcontroller::class,'update']); 
        
     // commnet controller 
        Route::post('comment',[commentcontroller::class,'store']); 
        Route::get('showcomment',[commentcontroller::class,'show']); 
        Route::post('deletecomment/{id}',[commentcontroller::class,'destroy']); 