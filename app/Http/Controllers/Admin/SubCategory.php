<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SubCategories;
use App\Models\Admin\Category;
use App\Models\Admin\pinOffice;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use App\imports\OfficesImport;

class SubCategory extends Controller
{
    public function index() {
        $categories = Category::all();
        $subCategories = SubCategories::all();
        return view('admin.subcategory.index', compact('categories', 'subCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'image' => 'required|max:2048',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $subcategory = new SubCategories;
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = \Str::slug($request->name);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('subcategories', $imageName, 'public');
            $subcategory->image = $imageName;
        }

        $subcategory->save();

        return redirect()->route('admin.sub.categories')->with('success', 'Subcategory created successfully.');
    }

    public function edit($id)
    {
        $subcategory = SubCategories::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $subcategory = SubCategories::findOrFail($id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('subcategories', 'public');
                $subcategory->images()->create(['path' => $imagePath]);
            }
        }

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = \Str::slug($request->name);
        $subcategory->save();

        return redirect()->route('admin.sub.categories')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy($id)
    {
        $subcategory = SubCategories::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('admin.sub.categories')->with('success', 'Subcategory deleted successfully.');
    }

    public function pinIndex(Request $request)
    {
        if ($request->ajax()) {
            $pinOffices = PinOffice::query();
    
            return DataTables::of($pinOffices)
                ->make(true);
        }

        return view('admin.pin.index');
    }

    public function import(Request $request)
    {
        
        return view('admin.pin.import-pin');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // if (class_exists('ZipArchive')) {
        //     dd("ZipArchive is available.");
        // } else {
        //     dd("ZipArchive is not available.");
        // }

        Excel::import(new OfficesImport, $request->file('file'));
        return view('admin.pin.import-pin')->with('success', 'Pin Offices Imported Successfully!');;
        // return redirect()->back()->with('success', 'Pin Offices Imported Successfully!');
    }
    public function pinallApi()
    {
        $pinOffices = PinOffice::all();
        return response()->json($pinOffices);
    }
}
