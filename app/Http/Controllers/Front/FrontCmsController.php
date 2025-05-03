<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Cms;

class FrontCmsController extends Controller
{
    public function AboutUs(Request $request)
    {
        $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        $page = Page::where('slug', $lastSegment)->with('cms.images')->first();
        if (!$page || !$page->cms) {
            abort(404); // or redirect or show a custom message
        }
        $seoMetaTag = $page->seo_meta_tag;
        $seoMetaTagTitle = $page->seo_meta_tag_title;
        $pageTitle = $page->page_title;
        return view('front.about-us', compact('page', 'seoMetaTag','seoMetaTagTitle' , 'pageTitle'));
    }

    public function TermsAndConditions(Request $request)
    {
        $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        $page = Page::where('slug', $lastSegment)->with('cms.images')->first();
        if (!$page || !$page->cms) {
            abort(404); // or redirect or show a custom message
        }
        $seoMetaTag = $page->seo_meta_tag;
        $seoMetaTagTitle = $page->seo_meta_tag_title;
        $pageTitle = $page->page_title;
        return view('front.terms-conditions', compact('page','seoMetaTag', 'seoMetaTagTitle','pageTitle'));
    }

    public function privacyPolicy(Request $request)
    {
        $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        $page = Page::where('slug', $lastSegment)->with('cms.images')->first();
        if (!$page || !$page->cms) {
            abort(404); // or redirect or show a custom message
        }
        $seoMetaTag = $page->seo_meta_tag;
        $seoMetaTagTitle = $page->seo_meta_tag_title;
        $pageTitle = $page->page_title;
        return view('front.privacy-policy',  compact('page','seoMetaTag', 'seoMetaTagTitle','pageTitle'));
    }
     public function getPageContent(){
        $pages = Page::whereIn('slug', ['about-us', 'terms-and-conditions', 'privacy-policy','faqs'])->get();
        $pageContents = [];
        foreach ($pages as $page) {
            $pageContents[$page->slug] = [
                'title' => $page->page_title,
                'content' => $page->seo_meta_tag
            ];
        }
        return response()->json($pageContents);
        
    }
   

}
