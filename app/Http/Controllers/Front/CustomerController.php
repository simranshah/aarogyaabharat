<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Customer; 
use App\Models\Admin\Status; 
use App\Models\User;
use App\Models\Front\Adress;
use App\Models\Admin\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Admin\PinOffice;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = 'c7262a4f-7fa5-11ef-8b17-0200cd936042';
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|unique:users,mobile',
            'city' => 'required|string|max:255',
            'pincode' => 'required|numeric|digits:6',
        ]);
        $alreadyExists = User::where('mobile', $request->input('mobile'))->exists();

        if ($alreadyExists) {
            $validator->after(function ($validator) use ($request) {
                if (User::where('mobile', $request->input('mobile'))->exists()) {
                    $validator->errors()->add('mobile', 'Mobile number already exists.');
                }
            });
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        
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
        // $pin = PinOffice::create([ 
        //     'district' => $request->input('city'), 
        //     'pin' => $request->input('pincode'), 
        //     'state' => $request->input('state'), 
        //     'available' => 1, 
        // ]);
        if ($customerPin) {
            $customer->update(['pincode_id' => $customerPin->id]);
        }
        $customer->assignRole('Customer');
        return view('front.onbord',compact('customer'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10', // Ensure exactly 10 digits
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customer = User::where('mobile', $request->input('mobile'))->first();

        if ($customer) {
            try {
                // https://2factor.in/API/V1/:api_key/SMS/:phone_number/AUTOGEN/:otp_template_name
                $response = $this->client->post("https://2factor.in/API/V1/{$this->apiKey}/SMS/{$customer->mobile}/AUTOGEN");
                // $response = $this->client->post("https://2factor.in/API/V1/{$this->apiKey}/SMS/{$customer->mobile}/AUTOGEN2");
                // dd($response);
                \Log::info(['otp response' => json_decode($response->getBody(), true)]);
                // Set OTP expiry to 5 minutes from now
                // $otpExpiry = Carbon::now()->addMinutes(5);
                // $customer->otp = $otp;
                // $customer->otp_expiry = $otpExpiry;
                // $customer->otp_verified_at = null; 
                // $customer->save();
                
            return response()->json([
                'success' => 'OTP sent to your mobile number!',
                'number' => $customer->mobile,
                'res' => json_decode($response->getBody(), true) 
            ], 200);
            } catch (RequestException $e) {
                return response()->json(['errors' => ['mobile' => ['No account found for this number. Please register.']]], 422);
            }
        } else {
            return response()->json(['errors' => ['mobile' => ['No account found for this number. Please register.']]], 422);
        }
    }

    public function verifyOtp(Request $request, $number)
    {
        // $request->validate([
        //     'otp' => 'required|digits:6',
        // ]);

        $customer = User::where('mobile', $number)->first();

        if (!$customer) {
            return response()->json(['errors' => ['otp' => 'Invalid mobile number.']], 422);
        }
        try {
            // https://2factor.in/API/V1/:api_key/SMS/VERIFY/:otp_session_id/:otp_entered_by_user
            // https://2factor.in/API/V1/:api_key/SMS/VERIFY3/:phone_number/:otp_entered_by_user
            $response = $this->client->post("https://2factor.in/API/V1/{$this->apiKey}/SMS/VERIFY3/{$number}/{$request->otp}");
            // dd($response);
            \Log::info(['otp verifiyed response' => json_decode($response->getBody(), true)]);
            // Set OTP expiry to 5 minutes from now
            // $otpExpiry = Carbon::now()->addMinutes(5);
            // $customer->otp = $otp;
            // $customer->otp_expiry = $otpExpiry;
            // $customer->otp_verified_at = null; 
            // $customer->save();
            $responseBody = json_decode($response->getBody(), true);
            if(isset($responseBody['Status']) && $responseBody['Status'] !== 'Success') {
                return response()->json(['errors' => ['otp' => 'Invalid OTP.']], 422);
            }else{
            Auth::login($customer, true);
            return redirect()->route('home')->with('success', 'OTP verified successfully! Welcome back, ' . $customer->name);
            return response()->json([
                'success' => 'OTP verified succesfully!',
                'res' => json_decode($response->getBody(), true) 
            ], 200);
        }
        } catch (RequestException $e) {
            return response()->json(['errors' => ['mobile' => ['Something went wrong. Please try again.']]], 422);
        }
        // if ($customer->otp === $request->otp && now()->lessThanOrEqualTo($customer->otp_expiry)) {
        //     // OTP is valid
        //     $customer->otp_verified = true; // Set the OTP verified status
        //     $customer->otp_verified_at = now(); // Set the verification timestamp
        //     $customer->save();

        //     // Log the user in without needing to re-enter credentials
        //     Auth::login($customer);
        //     return response()->json(['success' => 'OTP verified and logged in successfully', 'customer' => auth()->user()]);
        // } else {
        //     return response()->json(['errors' => ['otp' => 'Invalid or expired OTP.']], 422);
        // }
    }

    public function saveAddress(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['success' => false, 'status' => 401, 'message' => 'Please login as a customer and try again.']);
        }

        // Get the authenticated user
        $customer = auth()->user();

        // Check if the authenticated user has the 'Customer' role
        if (!$customer->hasRole('Customer')) {
            return response()->json(['success' => false, 'status' => 403, 'message' => 'Access denied. You do not have the required permissions.']);
        }

        // Validate the incoming request
        $validator = \Validator::make($request->all(), [
            'house_number' => 'required|string|max:255',
            'society_name' => 'required|string|max:255',
            // 'locality' => 'required|string|max:255',
            // 'landmark' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'user' => $customer, 'errors' => $validator->errors()]);
        }
        $deliveryAddressExists = Adress::where('customer_id', $customer->id)
                                ->where('is_delivery_address', true)
                                ->exists(); 
        if ($request->delivery == 1) {
            Adress::where('customer_id', $customer->id)
                    ->where('is_delivery_address', true)  
                    ->update(['is_delivery_address' => false]);
        }
                                                     
        // Update or Create the address
        Adress::updateOrCreate(
            [
                'customer_id' => $customer->id,
                'id' => $request->uuid,
            ],
            [
                'house_number' => $request->house_number,
                'society_name' => $request->society_name,
                // 'locality' => $request->locality, // If you need it, uncomment it
                'landmark' => $request->landmark,
                'pincode' => $request->pincode,
                'city' => $request->city,
                'state' => $request->state,
                'mobile' => $request->mobile,
                'name' => $request->name,
                'is_delivery_address' => $request->delivery ?? 0,
            ]
        );
        
        $customerAndAddresses = Auth::check() ? User::with(['addresses' => function ($query) {
            $query->where('is_delivery_address', true);
        }])->where('id', Auth::id())->first()->addresses 
        : null;

        $adressHtml = view('front.common.delivery-address', ['customerAndAddresses' => $customerAndAddresses])->render();

        return response()->json(['success' => true, 'adressHtml' => $adressHtml, 'message' => 'Address saved successfully.']);
    }

    public function getAddress($id)
    {
        $address = Adress::findOrFail($id);
        return response()->json($address);
    }

    public function removeAddress($id)
    {
        $address = Adress::find($id);
        $isDeliver=$address->is_delivery_address;
        if ($address) {
            $address->delete(); 
            $customerDetail = User::with('orders', 'addresses')
            ->where('id', Auth::user()->id)
            ->first();
            if($isDeliver==true){
                $Address=Adress::where('customer_id',Auth::user()->id)->first();
                
                if($Address){
                    $Address->update(['is_delivery_address' => 1]);
                    $Address->save();
                }
            }
            $addressListHtml = view('front.common.customer-address', ['customerDetail' => $customerDetail])->render();
            return response()->json(['success' => true, 'html' => $addressListHtml, 'message' => 'Address removed successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Address not found.'], 404);
        }
    }

    public function getUpdateAddress($id)
    {
        $address = Adress::findOrFail($id);
        $addressHtml = view('front.common.update-customer-address', ['address' => $address])->render();
        return response()->json(['success' => true, 'html' => $addressHtml, 'address' => $address]);
    }

    public function UpdateAddress(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['success' => false, 'status' => 401, 'message' => 'Please login as a customer and try again.']);
        }

        // Get the authenticated user
        $customer = auth()->user();

        // Check if the authenticated user has the 'Customer' role
        if (!$customer->hasRole('Customer')) {
            return response()->json(['success' => false, 'status' => 403, 'message' => 'Access denied. You do not have the required permissions.']);
        }

        // Validate the incoming request
        $validator = \Validator::make($request->all(), [
            'house_number' => 'required|string|max:255',
            'society_name' => 'required|string|max:255',
            // 'locality' => 'required|string|max:255',
            // 'landmark' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,  'errors' => $validator->errors()]);
        }
        if ($request->delivery == 1) {
            Adress::where('customer_id', $customer->id)
                    ->where('is_delivery_address', true)  
                    ->update(['is_delivery_address' => false]);
        }
                                                     
        // Update the address
        if ($request->delivery == 1) {
            Adress::where('customer_id',  $request->uuid)
                    ->where('is_delivery_address', true)  
                    ->update(['is_delivery_address' => false]);
        }
        $address = Adress::where('id', $request->uuid)->first();
        // Assuming $request contains the necessary data
        $address = Adress::updateOrCreate(
            [
                'id' => $request->uuid,
                'customer_id' => $customer->id
            ],  // Condition: check if an address with this UUID exists
            [
                'house_number' => $request->house_number,
                'society_name' => $request->society_name,
                'landmark' => $request->landmark,
                'pincode' => $request->pincode,
                'city' => $request->city,
                'state' => $request->state,
                'mobile' => $request->mobile,
                'name' => $request->name,
                'is_delivery_address' => $request->delivery ?? 0,
            ]
        );

        $customerDetail = User::with('orders', 'addresses')
            ->where('id', Auth::user()->id)
            ->first();
            $addressListHtml = view('front.common.customer-address', ['customerDetail' => $customerDetail])->render();
            return response()->json(['success' => true, 'html' => $addressListHtml, 'message' => 'Address updated successfully.']);
    }

    public function profile(Request $request)
    {
        // $customerDetail = User::with('orders', 'addresses')->where('id', Auth::user()->id)->first();
        $customerDetail = User::with([
            'orders' => function($query) {
                $query->whereHas('orderItems', function($q) {
                    $q->where('status_id', 1);
                });
            },
            'orders.orderItems.product.images',
            'orders.orderItems.status',
            'addresses'
        ])
        ->where('id', Auth::user()->id)
        ->first();
        $statuses = Status::all();

        //  $lastSegment = basename(parse_url($request->url(), PHP_URL_PATH));
        //  $contactPageData = Page::where('slug', $lastSegment)->with('cms.images')->first();
        //  $seoMetaTag = $contactPageData->seo_meta_tag;
        //  $seoMetaTagTitle = $contactPageData->seo_meta_tag_title;
        //  $pageTitle = $contactPageData->page_title;    
        // if ($customerDetail && $customerDetail->hasRole('Customer')) {
            return view('front.profile', compact('customerDetail','statuses'));
        // } 
    }

    public function profileUpdate(Request $request)
    {
        // return $request->all();
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'mobile' => 'required|string|max:15|unique:users,mobile,' . Auth::id(),
            'city' => 'required|string|max:255',
        ]);

        // Get the currently authenticated user
        $customer = Auth::user();
        
        // Update user properties
        $customer->name = $validatedData['full_name'];
        $customer->email = $validatedData['email'];
        $customer->mobile = $validatedData['mobile'];
        $customer->city = $validatedData['city'];
        
        // Save the user
        $customer->save();
        $profileHtml = view('front.common.profile-detail', ['customerDetail' => $customer])->render();
        return response()->json(['html' => $profileHtml, 'message' => 'Profile updated successfully']);
    }

    public function addAddress(Request $request)
    {
        $validatedData = $request->validate([
            'house_number' => 'required|string|max:255',
            'society' => 'required|string|max:255',
            'locality' => 'required|string|max:255',
            'landmark' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'name' => 'required|string|max:255',
        ]);
        $deliveryAddressExists = Adress::where('customer_id', Auth::id())
                                    ->where('is_delivery_address', true)
                                    ->exists();
        // Create the address record
        $address = new Adress(); // Adjust based on your model
        $address->customer_id = Auth::id(); // Assuming you are associating the address with the authenticated user
        $address->house_number = $validatedData['house_number'];
        $address->society_name = $validatedData['society'];
        $address->locality = $validatedData['locality'];
        $address->landmark = $validatedData['landmark'];
        $address->pincode = $validatedData['pincode'];
        $address->city = $validatedData['city'];
        $address->state = $validatedData['ṣtate'];
        $address->mobile = $validatedData['mobile'];
        $address->name = $validatedData['name'];
        $address->is_delivery_address =  $deliveryAddressExists ? 0 : 1;
        $address->save();

        $customerDetail = User::with('orders', 'addresses')
            ->where('id', Auth::user()->id)
            ->first();
        // Render updated address list or whatever you need
        $addressListHtml = view('front.common.customer-address', ['customerDetail' => $customerDetail])->render();

        return response()->json(['html' => $addressListHtml, 'message' => 'Address added successfully']);
    }

    public function customerLogout(Request $request){
        if (Auth::check() && Auth::user()->hasRole('Customer')) {
            Auth::logout();
        }
        return redirect()->back()->with('message', 'You have been logged out successfully.');
    }
    public function Notification(Request $request) 
{
    $notifications = collect();
    
    if (auth()->check() && auth()->user()->hasRole('Customer')) {
        // For logged-in customers
        $notifications = auth()->user()->notifications;
    } else {
        // For guest users - get public notifications
        $notifications = DB::table('guest_notifications')
            ->select('*', DB::raw("CONCAT('{\"title\":\"', title, '\", \"message\":\"', message, '\"}') as data"))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    $notificationHtml = view('front.common.notification', [
        'notifications' => $notifications
    ])->render();

    return response()->json([
        'message' => 'Notifications loaded',
        'notificationHtml' => $notificationHtml,
        'userType' => auth()->check() ? 'customer' : 'guest'
    ], 200);
}

    public function OrderStatusWise($statusId)
    {
          $customerDetail = User::with([
    'orders' => function($query) use ($statusId) {
        $query->whereHas('orderItems', function($q) use ($statusId) {
            $q->where('status_id', $statusId);
        })->with([ // Eager load the related items that match the status
            'orderItems' => function($q) use ($statusId) {
                $q->where('status_id', $statusId);
            },
            'orderItems.product.images',
            'orderItems.status'
        ]);
    },
    'addresses'
])
->where('id', Auth::user()->id)
->first();
            // \Log::info([$statusId => $customerDetail]);    
            $customerDetailHtml = view('front.common.customer-orders', compact('customerDetail'))->render();
            return response()->json(['success' => true,  'customerDetailHtml' => $customerDetailHtml, 'message' => 'Fetch order status wise.']);

    }

    public function saveLocation(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['success' => false, 'status' => 401, 'message' => 'Please login and try again.']);
        }

        // Get the authenticated user
        $customer = auth()->user();

        // Check if the authenticated user has the 'Customer' role
        if (!$customer->hasRole('Customer')) {
            return response()->json(['success' => false, 'status' => 403, 'message' => 'Access denied. You do not have the required permissions.']);
        }

        $deliveryAddressExists = Adress::where('customer_id', $customer->id)
                                ->where('is_delivery_address', true)
                                ->exists(); 
        // Create the address
        Adress::create([
            'customer_id' => $customer->id,
            'house_number' => $request->address['neighbourhood'],
            'society_name' => $request->address['neighbourhood'],
            'locality' => $request->address['neighbourhood'],
            'landmark' => $request->landmark,
            'pincode' => $request->address['postcode'],
            'city' => $request->address['city'],
            'state' => $request->address['state'],
            'mobile' => $request->address['mobile'],
            'name' => $request->address['name'],
            'is_delivery_address' => $deliveryAddressExists ? false : true,
        ]);

        // $userPincode = PinOffice::where('pin', '413603')->first();
        $userPincode = PinOffice::where('pin', $request->address['postcode'])->first();
        if ($userPincode) {
            if(Auth::check() && Auth::user()->hasRole('Customer')) {
                Auth::user()->update(['pincode_id' => $userPincode->id]); 
            }
            $userPincodeHtml = view('front.common.customer-pin', compact('userPincode'))->render();
            return response()->json(['success' => true, 'user' => $customer, 'userPincodeHtml' => $userPincodeHtml, 'message' => 'Address saved successfully.']);
        }
        return response()->json(['success' => true, 'user' => $customer, 'userPincodeHtml' => null, 'message' => 'Address saved successfully.']);
    }


    public function customerNotificationDestroy($id)
    {
        if (auth()->check() && auth()->user()->hasRole('Customer')) {
            $notification = auth()->user()->notifications()->find($id);
            if ($notification) {
                $notification->delete();
                $notifications = auth()->user()->notifications;   
                $notificationHtml = view('front.common.notification', compact('notifications'))->render();
                return response()->json(['success' => true,'message' => 'Notification deleted successfully', 'notificationHtml' => $notificationHtml, 'count' => $notifications->count()], 200);
            }
        }
        return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    }
    public function changeDeliverAddress(Request $request)
    {
        if (auth()->check() && auth()->user()->hasRole('Customer')) {
            $customer = auth()->user();
            $address = Adress::where('id', $request->address_id)->first();
            if ($address) {
                $customer->addresses()->update(['is_delivery_address' => false]);
                $address->update(['is_delivery_address' => true]);
                return response()->json(['success' => true, 'message' => 'Delivery address changed successfully.']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Address not found'], 404);
    }
    public function editAddress($id){
        $address = Adress::findOrFail($id);
        $addressHtml = view('front.common.open-update-adress', ['address' => $address])->render();
        return response()->json(['success' => true, 'html' => $addressHtml, 'address' => $address]);
    }
    public function removeOrderItem($id){
        if (auth()->check() && auth()->user()->hasRole('Customer')) {
            $customer = auth()->user();
            $orderItem = OrderItem::find($id);
            if ($orderItem) {
                $orderItem->status_id =7;
                $orderItem->save();
                return response()->json(['success' => true, 'message' => 'Order item removed successfully.']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Order item not found'], 404);
    }
}
