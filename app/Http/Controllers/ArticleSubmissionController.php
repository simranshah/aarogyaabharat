<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleSubmissionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'authorName' => 'required|string|max:255',
            'authorEmail' => 'required|email|max:255',
            'topic' => 'required|in:clinical-research,patient-care,public-health,medical-technology,nutrition,other',
            'title' => 'required|string|max:255',
            'abstract' => 'required|string|max:1000',
            'fileUpload' => 'required|file|mimes:doc,docx,pdf|max:10240', // 10MB max
        ]);

        // Handle file upload
        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            $fileName = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('writeforusdoc', $fileName, 'public');
        }

        // Create article record
        $article = Article::create([
            'author_name' => $validated['authorName'],
            'author_email' => $validated['authorEmail'],
            'topic' => $validated['topic'],
            'title' => $validated['title'],
            'abstract' => $validated['abstract'],
            'file_path' => $filePath,
        ]);

        // Optionally send notification email here

        return redirect()->back()->with('success', 'Your article has been submitted successfully!');
    }
}