<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreContactRequest; // Assuming you have a request class for validation
use App\Models\contact; // Ensure the model is correctly imported
use Illuminate\Support\Facades\Validator;

class contactController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contacts = contact::get()->all();
            return DataTables::of($contacts)
            ->addColumn('action', function ($contact) {
                return '';
            })
            ->editColumn('created_at', function ($contact) {
                return $contact->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($contact) {
                return $contact->updated_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.contact.contact-index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'phone_no' => 'required|digits_between:7,15', // Phone number must be numeric and between 7 to 15 digits
        ]);
        

        \App\Models\contact::create($request->all());

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
