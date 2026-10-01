<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Prompts\Table;
use PHPUnit\Metadata\Group;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//_________________________________________
// جلب جميع المنتجات مع التي تم إدخالها
/*
Route::get('products' , function(){
    DB::table('products_new')->insert([
        [
        "name"=> "ttrt",
        "description" => "Phone",
        "price"=> 30,
        "quantity" => 4,
      ],
      [

        "name" => "Samsung",
        "description" => "Smart Phone",
        "price" => 50,
        "quantity" => 10,
      ],
    ]);
    return DB::table('products_new')->get();
});
*/

//  جلب جميع البيانات المدخلة
//with controller
Route::get('products' , [ProductsController::class,'index']);



//______________________________________________
// جلب منتح واحد من خلال id
Route::get('products/{id}', function ($id) {        
return DB::table('products_new')->find($id);  
});

//__________________________________________
//إنشاء منتج جديد
Route::post('products' , function(){
    DB::table('products_new')->insert([
        [
            'name' => 'Laptop',
            'description' => 'Dell' ,
            'price'=> 5000,
            'quantity'=>5
        ]
    ]);
   return "The product added successfully";

});

//________________________________________
//تعديل منتج   
// without request
/*
Route::put('products/{id}' , function($id){
    DB::table('products_new')-> where('id' , $id)->update([
        'name' => 'Laptop ',
            'description' => 'Dell New Model',
            'price' => 6000,
            'quantity' => 10
    ]);
    return "The product updated successfully";
});
*/

//with request
Route::put('products/{id}' , function($id , Request $request){
    DB::table('products_new')->where('id' , $id)->update([
        'name'=>$request->name,
        'description'=>$request->description,
        'price'=>$request->price,
        'quantity'=>$request->quantity,
    ]);
    return "The product updated successfully";
});

//________________________________________
// حذف منتج
// without request
Route::delete('products/{id}' , function($id){
    DB::table('products_new')->where('id' , $id)->delete();
    return "The product deleted successfully";
});




//______________________________________________
//Retrieve All Projects
Route::get('projects' , function(){
   return DB::table('projects')->get();
});


//______________________________________________
//Create New Project
Route::post('projects' , function(Request $request){
    DB::table('projects')->insert([
      'name' =>$request->name,
      'description' =>$request->description,
      'start_date'=>$request->start_date,
      'end_date' =>$request->end_date,
      'status'=>$request->status,
    ]);
    return " Project added successfully";
});

//______________________________________________________
// Add new task
Route::post('tasks', function (Request $request) {  
    DB::table('tasks')->insert([
        'project_id' => $request->project_id,
        'title' => $request->title,
        'details' => $request->details,
        'status' => $request->status ?? 'ongoing',
        'priority' => $request->priority ?? 'medium',
        'due_date' => $request->due_date,
    ]);
     return 
         'Task added successfully' ;

});


//____________________________________________________
//add new comment
Route::Post('Comments', function(Request $request){ 
    DB::table('comments')->insert([
        'task_id' =>$request-> task_id,
        'comment_text' =>$request->comment_text,
        'author' =>$request-> author ,      
    ]);
     return 
         'Comment added successfully' ;
});


//_________________________________________________________
// delete comment
Route::delete('Comments/{id}', function ($id) {   

    DB::table('comments')
        ->where('id', $id)
        ->delete();

    return 'Comment deleted successfully';
});




//____________________________________________________
//return all comments
Route::get('Comments/{task_id}', function ($task) {
    return DB::table('comments')
        ->where('task_id', $task)
        ->get();

});

Route::prefix('categories')->group(function () {

    Route::get('/', [CategoriesController::class, 'index']);

    Route::post('/' , [CategoriesController::class,'store']);

    Route::put('/{id}' , [CategoriesController::class,'update']);

    Route::delete('/{id}' , [CategoriesController::class,'destroy']);
});