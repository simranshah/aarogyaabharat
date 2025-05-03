<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Front\RaiseQuery;
use App\Models\Admin\Page;
use App\Models\Admin\Cms;


class RaiseQueryController extends Controller
{
    public function index(Request $request)
    {
        $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        $rqPageData = Page::where('slug', $lastSegment)->with('cms.images')->first();
        $seoMetaTag = $rqPageData->seo_meta_tag ?? '';
        $seoMetaTagTitle = $rqPageData->seo_meta_tag_title ?? '';
        $pageTitle = $rqPageData->page_title ?? '';
        return view('front.raise-query', compact('seoMetaTag', 'seoMetaTagTitle' , 'pageTitle'));
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'product_name' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', 
            'description' => ['nullable', 'string', function($attribute, $value, $fail) {
                $wordCount = str_word_count($value);
                if ($wordCount < 10) {
                    $fail('The description must contain at least 10 words.');
                }
            }],  
            'terms' => 'required|accepted',  
        ], [
            'full_name.required' => 'Full name is required.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'The email address must be a valid email.',
            'mobile.required' => 'Please enter your mobile number.',
            'mobile.digits' => 'The mobile number must be exactly 10 digits.',
            'product_name.string' => 'Product name must be a valid string.',
            'file_upload.required' => 'File upload is required.',
            'file_upload.file' => 'Please upload a valid file.',
            'file_upload.mimes' => 'The file must be an image (jpg, jpeg, png) or a PDF.',
            'file_upload.max' => 'The file size must not exceed 5MB.',
            'description.string' => 'Description must be a valid string.',
            'description.regex' => 'The description must contain at least 10 words.',
            'terms.required' => 'You must accept the terms and conditions.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);
        


        // $validated = $request->validate([
        //     'full_name' => 'required',
        //     'email' => 'required|email',
        //     'mobile' => 'required|digits:10',
        //     'product_name' => 'nullable|string',
        //     'file_upload' => 'nullable|file',
        //     'description' => 'nullable|string',
        //     'terms' => 'required|accepted',  
        // ], [
        //     'full_name.required' => 'Full name is required.',
        //     'email.required' => 'Please enter your email address.',
        //     'email.email' => 'The email address must be a valid email.',
        //     'mobile.required' => 'Please enter your mobile number.',
        //     'mobile.digits' => 'The mobile number must be exactly 10 digits.',
        //     'product_name.string' => 'Product name must be a valid string.',
        //     'file_upload.required' => 'File upload is required.',
        //     'file_upload.file' => 'Please upload a valid file.',
        //     'description.string' => 'Description must be a valid string.',
        //     'terms.required' => 'You must accept the terms and conditions.',
        //     'terms.accepted' => 'You must accept the terms and conditions.',
        // ]);

        if ($request->hasFile('file_upload')) {
            $imagePath = $request->file('file_upload')->store('query', 'public');
            $validated['file_upload'] = $imagePath;
        }

        RaiseQuery::create([
            'user_id' => auth()->id(), 
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'product_name' => $validated['product_name'],
            'file_upload' => $validated['file_upload'] ?? null,
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('submitted', 'Your query has been submitted successfully.');
    }

}
