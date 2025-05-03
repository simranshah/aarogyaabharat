<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Cms;
use App\Models\Admin\Page;
use Yajra\DataTables\DataTables;
use Str;
use Illuminate\Support\Facades\Storage;

class CMSController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cmsRecords = Cms::with('page')->select('cms.*'); // Include 'cms.*' to select all cms fields

            return DataTables::of($cmsRecords)
                ->addColumn('page_name', function ($cms) {
                    return optional($cms->page)->name; // Get the name of the related page
                })
                ->addColumn('action', function ($cms) {
                    return '<a href="' . route('admin.cms.edit', $cms->id) . '" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i></a>
                            <a href="' . route('admin.cms.destroy', $cms->id) . '" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i></a>';
                })
                ->editColumn('status', function ($cms) {
                    return $cms->is_active ? 'Active' : 'Inactive';
                })
                ->editColumn('content', function ($cms) {
                    return Str::limit(strip_tags($cms->content), 50); // Strip HTML and limit content length
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.cms.index');
    }

    public function create()
    {
        $pages = Page::all();
        return view('admin.cms.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
            'image.*' => 'nullable|image|max:2048',
        ]);
        $cms = new Cms();
        $cms->page_id = $request->page_id;
        $cms->title = $request->title;
        $cms->description = $request->description;
        $cms->content = $request->content;
        $cms->is_active = $request->is_active ? true : false;
        
        $cms->save(); // Save the CMS record first to get the ID for the images
        
        // Handle image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $imagePath = $file->store('cms', 'public'); // Store each image
                $cms->images()->create([
                    'path' => $imagePath,
                    'alt' => $request->alt
                ]); // Save the image to the images table
            }
        }
        
        return redirect()->route('admin.cms')->with('success', 'CMS record created successfully.');
        
    }

    public function edit($id)
    {
        $cms = Cms::findOrFail($id);
        $pages = Page::all();
        return view('admin.cms.edit', compact('cms', 'pages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'page_id' => 'required|exists:pages,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'is_active' => 'nullable|boolean',
            'image.*' => 'nullable|image', 
        ]);
    
        // Find the CMS record
        $cms = Cms::findOrFail($id);
    
        // Update CMS record fields
        $cms->update([
            'page_id' => $request->page_id,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'is_active' => $request->is_active ?? true, // Default to true if not provided
        ]);
    
        // Handle image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                // dd($cms->images->first()->path);
                Storage::disk('public')->delete($cms->images->first()->path);
                $cms->images()->delete();
                $imagePath = $file->store('cms', 'public');
                $cms->images()->create([
                    'path' => $imagePath,
                    'alt' => $request->alt
                ]);
            }
        }
    
        // Redirect with success message
        return redirect()->route('admin.cms')->with('success', 'CMS record updated successfully.');
    }
    
    public function destroy($id)
    {
        $cms = Cms::findOrFail($id);
        $cms->delete();
        return redirect()->route('admin.cms')->with('success', 'CMS record deleted successfully.');
    }
}
