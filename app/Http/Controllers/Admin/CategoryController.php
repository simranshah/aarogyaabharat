<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Admin\Category;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::query();

            return DataTables::of($categories)
                ->addColumn('image', function ($category) {
                    return '<img src="' . asset('storage/' . $category->image) . '" width="50" height="50">';
                })
                ->addColumn('action', function ($category) {
                    return '<a href="' . route('admin.categories.edit', $category->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="' . route('admin.categories.destroy', $category->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.category.index'); // Make sure you return the view when not an ajax request
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        // Create the category
        Category::create([
            'name' => $request->name,
            'image' => $imagePath ?? null,
            'alt' => $request->alt,
            'slug' => \Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:svg,jpeg,png,jpg,gif|max:2048',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            // Handle the image upload
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }
        $category->name = $request->input('name');
        $category->slug = \Str::slug($request->input('name'));
        $category->alt = $request->input('alt');
        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }
}
