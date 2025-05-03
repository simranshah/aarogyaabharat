<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductAttribute;
use App\Models\Admin\Product;
use Yajra\DataTables\DataTables;

class ProductAttributeController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $attributes = ProductAttribute::get();
            foreach ($attributes as $attribute) {
                $name = Product::where('id', $attribute->product_id)->first();
                $attribute->name = $name->name;
            }

            return DataTables::of($attributes)
                ->addColumn('action', function ($attribute) {
                    return '<a href="' . route('admin.products.attribute.edit', $attribute->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="' . route('admin.products.attribute.destroy', $attribute->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
                })
                ->make(true);
        }

        return view('admin.product_atttribute.index');
    }


    public function create()
    {
        $products = Product::all();
        return view('admin.product_atttribute.create', compact('products'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'stock' => 'required',
            'size' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'material' => 'required',
            'brand' => 'required',
            'model_number' => 'required',
            'expiration_date' => 'required',
        ]);

        ProductAttribute::create($request->all());

        return redirect()->route('admin.products.attribute')->with('success', 'Product Attribute created successfully.');
    }

    public function edit($id)
    {
        $attribute = ProductAttribute::findOrFail($id);
        $products = Product::all();
        return view('admin.product_atttribute.edit', compact('attribute', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'material' => 'required',
            'brand' => 'required',
            'model_number' => 'required',
            'expiration_date' => 'required',
        ]);

        $attribute = ProductAttribute::findOrFail($id);
        $attribute->update($request->all());

        return redirect()->route('admin.products.attribute')->with('success', 'Product attribute updated successfully.');
    }

    public function destroy($id)
    {
        $attribute = ProductAttribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('admin.products.attribute')->with('success', 'Product Attribute deleted successfully.');
    }
}
