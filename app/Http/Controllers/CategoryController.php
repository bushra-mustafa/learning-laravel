<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Allcategory(){
        return view('admin.category.index');
    }
    public function Addcategory(Request  $request){

    }
}
