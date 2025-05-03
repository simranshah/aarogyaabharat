<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Cms;
use App\Models\Front\RaiseQuery;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ContactUsController extends Controller
{
    public function index(Request $request) {

        if ($request->ajax()) {
            $raiseQuery = RaiseQuery::select('id', 'full_name', 'email', 'mobile', 'product_name', 'file_upload', 'description', 'created_at')->get();
        
            return DataTables::of($raiseQuery)
                ->addColumn('action', function ($query) {
                    return '
                        <a href="' . route('admin.contactus.show', $query->id) . '" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>';
                })
                ->editColumn('description', function ($query) {
                    return Str::words($query->description, 10, '...');
                })
                ->editColumn('file_upload', function ($query) {
                    return $query->file_upload ? asset('storage/' . $query->file_upload) : null;
                })
                ->editColumn('created_at', function ($query) {
                    return $query->created_at->format('Y-m-d H:i');
                })
                ->make(true);
        }
        
        return view('admin.contact.index');        
        
    }

    public function showDetails($id)
    {
        $raiseQuery = RaiseQuery::findOrFail($id);
        return view('admin.contact.show', compact('raiseQuery'));
    }

    public function frontIndex(Request $request) {

        $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        $contactPageData = Page::where('slug', $lastSegment)->with('cms.images')->first();
        $seoMetaTag = $contactPageData->seo_meta_tag;
        $seoMetaTagTitle = $contactPageData->seo_meta_tag_title;
        $pageTitle = $contactPageData->page_title;
        return view('front.contact' , compact('seoMetaTag', 'seoMetaTagTitle', 'contactPageData' , 'pageTitle'));
    }
}
