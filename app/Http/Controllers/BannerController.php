<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Admin\PinOffice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    // Display a list of banners
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    // Show the form to create a new banner
    public function create()
    {
        return view('admin.banner.create');
    }

    // Store a new banner
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|unique:users,mobile',
            'city' => 'required|string|max:255',
            'pincode' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $customer = User::create([
                'name' => $request->input('full_name'),
                'password' => bcrypt($request->input('mobile')),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'city' => $request->input('city'),
                'pin_code' => $request->input('pincode'),
                'state' => $request->input('state'),
            ]);

            $customerPin = PinOffice::where(['pin' => $request->input('pincode')])->first();

            if ($customerPin) {
                $customer->update(['pincode_id' => $customerPin->id]);
            }

            $customer->assignRole('Customer');

            DB::commit();

            return response()->json(['success' => 'Customer registered successfully!'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }


    // Show the form to edit a specific banner
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
    }

    // Update a specific banner
    public function update(Request $request, $id)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'link' => 'nullable|url',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'nullable|boolean',
        'display_order' => 'nullable|integer',
        // 'is_mobile' => 'boolean',
    ]);
  
    $banner = Banner::find($id);
    
    if ($request->hasFile('image')) {
        if ($banner->image) {
            \Storage::disk('public')->delete($banner->image);
        }
        $imagePath = $request->file('image')->store('banners', 'public');
        $validatedData['image'] = $imagePath;
        $banner->image = $validatedData['image'];
    }

    if ($request->status == true) {
        $validatedData['status'] = 1;
    } else {
        $validatedData['status'] = 0;
    }

    $banner->title = $validatedData['title'];
    $banner->description = $validatedData['description'];
    $banner->link = $validatedData['link'];  // Set the link
    $banner->status = $validatedData['status'];
    $banner->display_order = $validatedData['display_order'];
    $banner->is_mobile = $request->has('is_mobile') ? 1 : 0;

    // Save the banner to the database
    $banner->save();

    // Redirect with success message
    return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
}


    // Delete a specific banner
    public function destroy($id)
    {
        $banner = Banner::where('id', $id)->first();
        // dd($banner);
        if ($banner->image) {
            \Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }

    public function pinCheck(Request $request) {

        $request->validate([
            'pin' => 'required|string|max:10', // Adjust validation rules as needed
        ]);
        $pin = $request->input('pin');
        $exists = PinOffice::where('pin', $pin)->exists();
        $userPincode = PinOffice::where('pin', $pin)->first();
        if ($userPincode) {
            if(Auth::check() && Auth::user()->hasRole('Customer')) {
                Auth::user()->update(['pincode_id' => $userPincode->id]); 
            }
            $userPincodeHtml = view('front.common.customer-pin', compact('userPincode'))->render();
            return response()->json(['available' => true, 'userPincodeHtml' => $userPincodeHtml]);
        }
        $userPincodeHtml =  view('front.common.customer-pin', compact('userPincode'))->render();
        return response()->json(['available' => $exists, 'userPincodeHtml' => $userPincodeHtml, 'redirect' => route('raise.query'),]);        
    }

    public function getCityState($pincode)
    {
        try {
            $data = PinOffice::where('pin', $pincode)->first();

            if ($data) {
                return response()->json([
                    'success' => true,
                    'city' => $data->district,
                    'state' => $data->state
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'No match found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }

    public function bannerStore(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size: 2MB
            'status' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
            // 'is_mobile' => 'boolean',
        ]);

        // Check validation failure
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public'); // Stores in 'storage/app/public/banners'
        }

        // Create banner record
        Banner::create([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status ?? 0,
            'display_order' => $request->display_order ?? 0,
            'is_mobile' => $request->has('is_mobile') ? 1 : 0, // Defaults to desktop if unchecked
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner created successfully.');
    }
}
