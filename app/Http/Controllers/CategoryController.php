<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth as FacadesAuth;

class CategoryController extends Controller
{
    public function Allcategory()
    {
        // Query Builder Join Table
        //** */ $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.email')
        //     ->latest()
        //     ->simplePaginate(5);
        $categories = Category::All();

        // Eloquent ORM Read Data
        $categories = Category::latest()->simplePaginate(5);
        $trachCat = Category::onlyTrashed()->latest()->simplePaginate(3);

        // Query Builder Read Data
        // $categories= DB::table('categories')->latest()->get();
        // $categories= DB::table('categories')->latest()->simplePaginate(5);

        return view('admin.category.index', compact('categories', 'trachCat'));
    }
    public function Addcategory(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',
            ],
            [
                'category_name.required' => 'Please Input Category Name ',
                'category_name.max' => ' Category Less Then 255Char ',
            ]
        );

        // Category::insert([
        //     'category_name'=>$request->category_name,
        //     'user_id' =>Auth::user()->id,
        //     'created_at'=>Carbon::now()
        // ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = FacadesAuth::user()->id;
        $category->save();
        // $data=array();
        // $data['category_name']=$request->category_name;
        // $data['user_id']=Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()
            ->back()
            ->with('success', 'Category Inserted Succesfully');
    }


    public function Edit($id)
    {
        // Eloquent ORM Edit
        // $categories = Category::find($id);

        // Query Builder Edit Data
        $categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.category.edit', compact('categories'));
    }



    public function Update(Request $request, $id)
    {
        // Eloquent ORM Update
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => FacadesAuth::user()->id,
        // ]);


        // Query Builder Edit Data

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = FacadesAuth::user()->id;
        DB::table('categories')->where('id', $id)->update($data);
        return Redirect()
            ->route('category')
            ->with('success', 'Category Update Succesfully');
    }
    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();
        return
            redirect()
            ->back()
            ->with('success', 'Category Soft Deleted Succesfully');
    }

    public function Restore($id)
    {
        $delete = Category::withTrashed()
            ->find($id)
            ->restore();

        return redirect()->back()->with('success', 'Category restore  Succesfully');
    }

    public function Pdelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forcedelete();
        return redirect()->back()->with('success', 'Category Pdeleyt  Succesfully');
    }
}
