<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\FAQ;
use App\Models\Admin\FAQAnswer;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Config;
use App\Models\Admin\Page;
use App\Models\Admin\Cms;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faqs = FAQ::with('answers')->select('id', 'question'); 

            return DataTables::of($faqs)
                ->addColumn('answers', function ($faq) {
                    return implode(', ', $faq->answers->pluck('answer')->toArray()); 
                })
                ->addColumn('action', function ($faq) {
                    return '<a href="' . route('admin.faqs.edit', $faq->id) . '" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="' . route('admin.faqs.destroy', $faq->id) . '" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>';
                })
                ->make(true);
        }

        return view('admin.faq.index');
    }

    public function fontIndex(Request $request)
    {
        $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        $faqPageData = Page::where('slug', $lastSegment)->with('cms.images')->first();
        $seoMetaTag = $faqPageData->seo_meta_tag ?? '';
        $seoMetaTagTitle = $faqPageData->seo_meta_tag_title ?? '';
        $pageTitle = $faqPageData->page_title ?? '';
        $faqFilters = Config::get('custom.faq_filter');
        return view('front.faqs', compact('faqFilters', 'seoMetaTag', 'seoMetaTagTitle', 'faqPageData' , 'pageTitle'));
    }

    public function create()
    {
        $categories = Config::get('custom.faq_filter');
        return view('admin.faq.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'question' => 'required|string|max:255',
            'category' => 'required',
            'answer' => 'required|string|max:1000',
        ]);

        $faq = FAQ::create([
            'question' => $request->question,
            'category' => $request->category,
        ]);

        $faq->answers()->create([
            'answer' => $request->answer,
        ]);

        return redirect()->route('admin.faqs')->with('success', 'FAQ created successfully!');
    }

    public function edit($id)
    {
        $faq = FAQ::with('answers')->findOrFail($id);
        $categories = Config::get('custom.faq_filter');
        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'question' => 'required|string|max:255',
            'category' => 'required',
            'answer' => 'required|string',
        ]);

        $faq = FAQ::findOrFail($id);

        $faq->update([
            'question' => $request->question,
            'category' => $request->category,
        ]);

        FAQAnswer::where('faq_id', $faq->id)->update([
            'answer' => $request->answer
        ]);

        return redirect()->route('admin.faqs')->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq->answers()->delete();
        $faq->delete();

        return redirect()->route('admin.faqs')->with('success', 'FAQ deleted successfully.');
    }
}
