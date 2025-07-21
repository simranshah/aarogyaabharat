<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Brand;
class BrandController extends Controller
{
    public function index() {
        $brands = Brand::all();
        // $subCategories = SubCategories::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug=  \Str::slug($request->name);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/Brand'), $imageName);
            $brand->image = $imageName;
        }

        $brand->save();

        return redirect()->route('admin.brand')->with('success', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->image && file_exists(public_path('storage/Brand/' . $brand->image))) {
            unlink(public_path('storage/Brand/' . $brand->image));
        }
        $brand->delete();
        return redirect()->route('admin.brand')->with('success', 'Brand deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = \Str::slug($request->name);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/Brand'), $imageName);
            $brand->image = $imageName;
        }

        $brand->save();

        return redirect()->route('admin.brand')->with('success', 'Brand created successfully.');
    }

}
