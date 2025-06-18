<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Blog;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Str;
use Illuminate\Support\Facades\Cache;
use App\Models\Admin\Page;
use App\Models\Admin\Product;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blogs = Blog::with('images')->select('blogs.*');

            return DataTables::of($blogs)
                ->addColumn('image', function ($blog) {
                    return $blog->images->isNotEmpty()
                        ? '<img src="' . asset('storage/' . $blog->images->first()->path) . '" alt="' . $blog->title . '" width="50">'
                        : 'No Image';
                })
                ->addColumn('action', function ($blog) {
                    return '<a href="' . route('admin.blogs.edit', $blog->id) . '" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i></a>
                                <a href="' . route('admin.blogs.edit2', $blog->id) . '" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i></a>
                            <a href="' . route('admin.blogs.destroy', $blog->id) . '" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i></a>';
                })
                ->editColumn('description', function ($blog) {
                    return Str::limit(strip_tags($blog->description), 50); // Strip HTML and limit description length
                })
                ->rawColumns(['image', 'action']) // Allow HTML in these columns
                ->make(true);
        }

        return view('admin.blogs.index');
    }


    public function fontIndex(Request $request)
    {
        $trendingBlogs = Blog::with('images')->inRandomOrder()->take(4)->get();
        $totalBlogs = Blog::count();
        $currentPage = $request->get('page', 1);
        $perPage = 3;
        $offset = ($currentPage - 1) * $perPage;
       $blogs = Blog::with('images')->skip($offset)->take($perPage)->latest()->get();
        $oneBlog = Blog::with('images')->inRandomOrder()->first();
        if($request->ajax()){
            $currentPage = $request->get('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $blogs = Blog::with('images')->skip($offset)->take($perPage)->latest()->get();
            $recommendedBlogHtml = view('front.common.recommended-blog', compact('blogs', 'oneBlog', 'totalBlogs', 'perPage', 'currentPage'))->render();
            return response()->json(['success' => true, 'recommendedBlogHtml' => $recommendedBlogHtml]);
        }
        $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        $page = Page::where('slug', $lastSegment)->first();
        $seoMetaTag = $page->seo_meta_tag;
        $seoMetaTagTitle = $page->seo_meta_tag_title;
        $pageTitle = $page->page_title;
        return view('front.blogs', compact('blogs', 'oneBlog', 'trendingBlogs', 'totalBlogs', 'perPage', 'currentPage' , 'seoMetaTag','seoMetaTagTitle', 'pageTitle'));
    }

    public function blogDetials(Request $request, $slug)
    {
        $blogDetails = Blog::where('slug', $slug)->with('images')->first();
        $twoBlogs = Blog::with('images')->inRandomOrder()->take(2)->get();
        $viewCacheKey = 'viewed_' . Str::replace('.', '', $request->ip()) . '-' . $blogDetails->id;
        if (!Cache::has($viewCacheKey)) {
            $blogDetails->increment('views');            
            Cache::put($viewCacheKey, true, now()->addDay(1));            
        }
        $seoMetaTag = $blogDetails->description ?? '';
        $seoMetaTagTitle = $blogDetails->page_title ?? '';
        $pageTitle = $blogDetails->page_title ?? '';
        return view('front.blog-details', compact('blogDetails', 'twoBlogs', 'seoMetaTag','seoMetaTagTitle', 'pageTitle'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_html' => 'required|string',
        ]);

        $blog = new Blog();
        $blog->name = $request->name;
        $blog->slug = \Str::slug($request->name);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content_html = $request->content_html;
        $blog->author = $request->article_author;
        $blog->tagname = $request->tagename;
        $blog->seo_meta_tag = $request->seo_meta_tag;
        $blog->seo_meta_tag_title = $request->seo_meta_tag_title;
        $blog->page_title = $request->page_title;
        $blog->save();

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
            $blog->images()->create([
                'path' => $imagePath,
                'alt' => $request->alt
            ]);
        }

        return redirect()->route('admin.blogs')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_html' => 'required|string',
            // 'image' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $blog = Blog::findOrFail($id);
        $blog->name = $request->input('name');
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->content_html = $request->input('content_html');
        $blog->tagname = $request->input('tagename');
        $blog->author = $request->input('article_author');
        $blog->seo_meta_tag = $request->seo_meta_tag;
        $blog->seo_meta_tag_title = $request->seo_meta_tag_title;
        $blog->page_title = $request->page_title;
        $blog->save();
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($blog->images->isNotEmpty()) {
                Storage::disk('public')->delete($blog->images->first()->path);
                $blog->images()->delete();
            }

            // Store the new image
            $imagePath = $request->file('image')->store('blogs', 'public');
            $blog->images()->create([
                'path' => $imagePath,
                'alt' => $request->alt
            ]);
        }

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog, $id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->images->isNotEmpty()) {
            Storage::disk('public')->delete($blog->images->first()->path);
            $blog->images()->delete();
        }
        $blog->delete();
        return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully');
    }
    public function blogSearch(Request $request)
    {
        $search = $request->input('search');
        // dd($search);
        $blogs = Blog::where('name', 'LIKE', "%{$search}%")
            ->orWhere('title', 'LIKE', "%{$search}%")
            ->with('images')
            ->get();
    //   dd($blogs);
       return view('front.common.blog-search', compact('blogs'));
    }
    public function blogSearchResult ($request)
    {
        $search = $request;
        $blogs = Blog::where('name', 'LIKE', "%{$search}%")
            ->orWhere('title', 'LIKE', "%{$search}%")
            ->with('images')
            ->get();
        $page = Page::where('slug', 'blogs')->first();
        $seoMetaTag = $page->seo_meta_tag;
        $seoMetaTagTitle = $page->seo_meta_tag_title;
        $pageTitle = $page->page_title;
        // dd($blogs->images);
        return view('front.blog-search', compact('blogs', 'seoMetaTag','seoMetaTagTitle' , 'pageTitle'));
    }
     public function newcreate()
    {
        $products=Product::with('category')->get();
        return view('admin.blogs.new-add-form', compact('products'));
    }
    public function newstore(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            'image' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_html' => 'required|string',
            'meta_description' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            
        ]);
    //   dd($request->all());
        $blog = new Blog();
        $blog->name = $request->title;
        $blog->slug = \Str::slug($request->title);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content_html = $request->content_html;
        $blog->author = $request->article_author;
        $blog->tagname = $request->tagename;
        $blog->seo_meta_tag = $request->meta_description;
        $blog->seo_meta_tag_title = $request->meta_title;
        $blog->page_title = $request->title;
        $blog->blog_product_ids = $request->product_ids; // Store product IDs as JSON
        $blog->save();

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
            $blog->images()->create([
                'path' => $imagePath,
                'alt' => $request->alt
            ]);
        }

        return redirect()->route('admin.blogs')->with('success', 'Blog created successfully.');
    }
    public function newedit($id)
    {
        $blog = Blog::findOrFail($id);
        $products = Product::with('category')->get();
        return view('admin.blogs.new-edit-form', compact('blog', 'products'));
    }
    public function newupdate(Request $request, $id)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content_html' => 'required|string',
            'meta_description' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            // 'image' => 'required',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $blog = Blog::findOrFail($id);
         $blog->name = $request->title;
        $blog->slug = \Str::slug($request->title);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content_html = $request->content_html;
        $blog->author = $request->article_author;
        $blog->tagname = $request->tagename;
        $blog->seo_meta_tag = $request->meta_description;
        $blog->seo_meta_tag_title = $request->meta_title;
        $blog->page_title = $request->title;
        $blog->blog_product_ids = $request->product_ids; // Store product IDs as JSON
        $blog->save();
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($blog->images->isNotEmpty()) {
                Storage::disk('public')->delete($blog->images->first()->path);
                $blog->images()->delete();
            }

            // Store the new image
            $imagePath = $request->file('image')->store('blogs', 'public');
            $blog->images()->create([
                'path' => $imagePath,
                'alt' => $request->alt
            ]);
        }

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully');
    }

   
}
