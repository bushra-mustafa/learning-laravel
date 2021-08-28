<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Maltipic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Unique;
use Intervention\Image\Facades\Image;

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
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $imge_name = $name_gen . '.' . $img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location . $imge_name;
        // $brand_image->move($up_location, $imge_name);

        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('image/brand/' . $name_gen);
        $last_img = 'image/brand/' . $name_gen;
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()
            ->back()
            ->with('success', 'Brand insert Success');
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
    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);
        $brands = Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Delete Success');
    }

    public function multipic()
    {
        $images = Maltipic::All();
        $images = Maltipic::latest()->simplePaginate(5);
        return view('admin.multipic.index', compact('images'));
    }
    public function stormulti(Request $request)
    {
        $validated = $request->validate(
            ['image' => 'required|mimes:jpg.jpeg,png',]
        );
        $images = $request->file('image');
        foreach ($images as $multi_img) {
            $name_gen = hexdec(uniqid()) . '.' . $multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300, 300)->save('image/brand/' . $name_gen);
            $last_img = 'image/brand/' . $name_gen;
            Maltipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        };
        return Redirect()->back()
            ->with('success', 'Multi Image insert Success');
    }
}
