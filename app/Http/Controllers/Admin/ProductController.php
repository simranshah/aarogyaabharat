<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\ProductAttribute;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('category');
    
            return DataTables::of($products)
                ->addColumn('image', function ($product) {
                    return $product->image
                        ? '<img src="' . asset('storage/' . $product->image) . '" width="50" height="50">'
                        : 'No image';
                })
                ->addColumn('category', function ($product) {
                    return $product->category ? $product->category->name : 'No category';
                })
                ->addColumn('action', function ($product) {
                    return '<a href="' . route('admin.products.edit', $product->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="' . route('admin.products.destroy', $product->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
    
        return view('admin.product.index');
    }
    
    public function create() {
        $categories = Category::all();
        $attributes = ProductAttribute::all();
        return view('admin.product.create', compact('categories', 'attributes'));
    }

    public function store(StoreProductRequest $request)
    {
    
        $validated = $request->validated();
        $product = new Product();
        $product->name = $request->name;
        $product->slug = \Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->features_specification = $request->features_specification;
        $product->price = $request->price;
        $product->original_price = $request->price;
        $product->our_price = $request->price - ($request->price * $request->dicount_percentage / 100);
        $product->monthly_price = $request->monthly_price;
        $product->is_rentable = $request->has('is_rentable') ? true : false;
        $product->is_popular = $request->has('is_popular') ? true : false;
        $product->is_new = $request->has('is_new') ? true : false;
        $product->top_pick_for_you = $request->has('top_pick_for_you') ? true : false;
        $product->top_deals= $request->has('top_deals') ? true : false;
        $product->best_selling_products = $request->has('best_selling_products') ? true : false;
        $product->sports_healthcare_more = $request->has('sports_healthcare_more') ? true : false;
        $product->flash_sale = $request->has('flash_sale') ? true : false;
        $product->gst = $request->gst;
        $product->about_item = $request->about_item;
        $product->image = 'temp';
        $product->measurements = $request->measurements ?? null;
        $product->usage_instructions = $request->usage_instructions ?? null;
        $product->why_choose_this_product = $request->why_choose_this_product ?? null;
       
        $product->discount_percentage = $request->dicount_percentage ?? null;
        $product->page_title = $request->page_title ?? null;
        $product->seo_meta_tag_title = $request->seo_meta_tag_title ??  null;
        $product->seo_meta_tag = $request->seo_meta_tag ?? null;
        $product->delivery_and_installation_fees = $request->delivery_and_installation_fees;
        $product->save();
        if ($request->hasFile('image')) {
            $firstFile = $request->file('image')[0]; 
            $firstImagePath = $firstFile->store('products', 'public'); 
            $product->update(['image' => $firstImagePath]);
            foreach ($request->file('image') as $key => $file) {
                $imagePath = $file->store('products', 'public'); 
                $product->images()->create([
                    'path' => $imagePath,
                    'alt' => $request->alt
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'features_specification' => 'nullable|string',
            'price' => 'required|numeric',
            'weekly_price' => 'nullable|numeric',
            // 'gst' => 'nullable|numeric',
            // 'is_rentable' => 'nullable|boolean',
            // 'is_popular' => 'nullable|boolean',
            // 'is_new' => 'nullable|boolean',
            // 'about_item' => 'nullable|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $product = Product::where('id',$id)->first();
        // dd($product ,$id, $request->all());
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->features_specification = $request->features_specification;
        $product->price = $request->price;
        $product->original_price = $request->price;
        $product->our_price = $request->price - ($request->price * $request->dicount_percentage / 100);    
        $product->weekly_price = $request->weekly_price;
        $product->gst = $request->gst;
        $product->is_rentable = $request->has('is_rentable') ? true : false ;
        $product->is_popular = $request->has('is_popular') ? true : false;
        $product->is_new = $request->has('is_new') ? true : false;
        $product->top_pick_for_you = $request->has('top_pick_for_you') ? true : false;
        $product->top_deals = $request->has('top_deals') ? true : false;
        $product->best_selling_products = $request->has('best_selling_products') ? true : false;
        $product->sports_healthcare_more = $request->has('sports_healthcare_more') ? true : false;
        $product->flash_sale = $request->has('flash_sale') ? true : false;
        $product->about_item = $request->about_item;
        $product->discount_percentage = $request->dicount_percentage;
        $product->page_title = $request->page_title;
        $product->seo_meta_tag_title = $request->seo_meta_tag_title;
        $product->seo_meta_tag = $request->seo_meta_tag;
        $product->delivery_and_installation_fees = $request->delivery_and_installation_fees;
        $product->measurements = $request->measurements ?? null;
        $product->usage_instructions = $request->usage_instructions ?? null;
        $product->why_choose_this_product = $request->why_choose_this_product ?? null;
        $product->save();
            if ($request->hasFile('image')) {
                if ($product->images->isNotEmpty()) {
                    foreach ($product->images as $image) {
                        if (Storage::disk('public')->exists($image->path)) {
                            Storage::disk('public')->delete($image->path);
                        }
                        $image->delete();
                    }
                }
            
                $firstFile = $request->file('image')[0]; 
                $firstImagePath = $firstFile->store('products', 'public'); 
                $product->image = $firstImagePath;
                $product->update(['image' => $firstImagePath]);
                foreach ($request->file('image') as $key => $file) {
                    $imagePath = $file->store('products', 'public'); 
                    $product->images()->create([
                        'path' => $imagePath,
                        'alt' => $request->alt
                    ]);
                }
        }
    
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $category = Product::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    public function importProduct()
    {
        return view('admin.product.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Products imported successfully.');
    }
     public function outofstock(Request $request){
        if ($request->ajax()) {
            $attributes = ProductAttribute::where('stock', '<', 5)->with('product')->get();
            foreach ($attributes as $attribute) {
                $attribute->name = $attribute->product->name ?? 'Unknown';
            }
            
            
            return DataTables::of($attributes)
                ->addColumn('action', function ($attribute) {
                    return '<a href="' . route('admin.products.attribute.edit', $attribute->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="' . route('admin.products.attribute.destroy', $attribute->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
                })
                ->make(true);
        }

        return view('admin.product.out-off-stock');
    }

}
