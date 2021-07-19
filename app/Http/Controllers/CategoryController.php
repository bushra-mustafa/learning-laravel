<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Allcategory(){
        return view('admin.category.index');
    }
    public function Addcategory(Request  $request){
        $validated = $request->validate([
            'user_id' => 'required|unique:categories|max:255',
            'category_name' => 'required',
        ],
    [
        'category_name.required' => 'Please Input Category Name ',
        'category_name.max' => ' Category Less Then 255Char '
    ]);
    }

}
