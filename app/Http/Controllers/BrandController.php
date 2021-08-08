<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Unique;

class BrandController extends Controller
{
    public function Allbrand()

    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }
    public function addbrand(Request $request)

    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg.jpeg,png',
            ],
            [
                'brand_name.required' => 'Please Input Brands Name ',
                'brand_name.min' => ' Brands Longer 4 Characters ',
            ]
        );
        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $imge_name = $name_gen . '.' . $img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location . $imge_name;
        $brand_image->move($up_location, $imge_name);
        // dd($imge_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand insert Success');
    }

    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view(
            'admin.brand.edit',
            compact('brands')
        );
    }
    public function Update(Request $request, $id)
    {
        $validated = $request->validate(

            [
                'brand_name' => 'required',

            ],
            [
                'brand_name.required' => 'Please Input Brands Name ',
                'brand_name.min' => ' Brands Longer 4 Characters ',
            ]
        );
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if ($brand_image) {

            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $imge_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $imge_name;
            $brand_image->move($up_location, $imge_name);

            unlink($old_image);
            $brands = Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            return Redirect()->route('brand')->with('success', 'Brand update Success');
        } else {
            $brands = Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
            return Redirect()->route('brand')->with('success', 'Brand update Success');
        }
    }
    public function SoftDelete()
    {
    }
    public function Restore()
    {
    }
    public function Pdelete()
    {
    }
}
