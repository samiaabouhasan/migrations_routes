<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatCategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{    // without model
    //جلب جميع البيانات
    /*
    public function index(){
        return DB::table('categories')->get();
   }

//  Add new Categorie
   public function store(Request $request ){
     DB::table('categories')->insert([
        'name' => $request->name,
        'description' => $request->description,
        
    ]);
      return 
         'Categorie added successfully' ;
   }

   public function update( Request $request ,$id ){
    DB::table('categories')->where('id' , $id)->update([
        'name'=>$request->name,
        'description'=>$request->description,
        
    ]);
    return "The Category  updated successfully";
   }

   public function destroy(Request $request , $id){
    DB::table('categories')->where('id' , $id)->delete();
    return "The Category  deleted successfully";


}

*/
// with model
//جلب جميع البيانات
    
    public function index(){
        return Category::query()->get();
   }

//  Add new Category
   /*public function store(Request $request ){
     Category::query()->insert([
        'name' => $request->name,
        'description' => $request->description,
        
    ]);
      return 
         'Category added successfully' ;
   }
*/


//  Add new Category with form request
public function store(CatCategoryStoreRequest $request ){
     Category::query()->create($request->validated() );
      return 
         'Category added successfully' ;
   }


//update 
   public function update( Request $request ,$id ){
    Category::query()->where('id' , $id)->update([
        'name'=>$request->name,
        'description'=>$request->description,
        
    ]);
    return "The Category  updated successfully";
   }

   public function destroy(Request $request , $id){
    Category::query()->where('id' , $id)->delete();
    return "The Category  deleted successfully";


}


}