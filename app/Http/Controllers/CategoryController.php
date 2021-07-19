<?php

namespace App\Http\Controllers;
use App\Models\Category ;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Auth;


class CategoryController extends Controller
{
    public function Allcategory(){
        $
        return view('admin.category.index');
    }
    public function Addcategory(Request  $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255'

        ],
    [
        'category_name.required' => 'Please Input Category Name ',
        'category_name.max' => ' Category Less Then 255Char '
    ]);

    // Category::insert([
    //     'category_name'=>$request->category_name,
    //     'user_id' =>Auth::user()->id,
    //     'created_at'=>Carbon::now()
    // ]);
    // $category= new Category();
    // $category->category_name= $request->category_name;
    // $category->user_id=Auth::user()->id;
    // $category->save();
$data=array();
$data['category_name']=$request->category_name;
$data['user_id']=Auth::user()->id;
DB::table('categories')->insert($data);

    return Redirect()->back()->with('success' , 'Category Inserted Succesfully' );

}

}
