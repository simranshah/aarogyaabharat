<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GuestNotification; // New model for non-registered users
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Notifications\UserNotification;

class CustomerNotification extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $usersWithCustomerRole = User::role('Customer')->pluck('id'); 
            $notifications = \DB::table('notifications')
                ->whereIn('notifiable_id', $usersWithCustomerRole) 
                ->get();

            // Return the data to DataTables
            return DataTables::of($notifications)
                ->addColumn('customer_name', function ($notification) {
                    // Find the user related to the notification (notifiable)
                    $user = User::find($notification->notifiable_id);
                    return $user ? $user->name : 'N/A';
                })
                ->addColumn('notification_message', function ($notification) {
                    $data = json_decode($notification->data, true);
                    return $data['message'] ?? 'No message';
                })
                ->addColumn('action', function ($notification) {
                    return '<a href="' . route('admin.notification.edit', $notification->id) . '" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="' . route('admin.notification.destroy', $notification->id) . '" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>';
                })
                ->rawColumns(['action']) // To allow HTML rendering in 'action' column
                ->make(true);
        }

        // If not an AJAX request, just return the view
        return view('admin.notifications.index');
    }

    public function create(Request $request)
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'message' => 'required|string|max:255',
            // 'send_to' => 'required|in:customers,guests,both'
        ]);

        $title = $validated['title'];
        $message = $validated['message'];
        
        // Send to registered customers if selected
        if (true) {
            $customers = User::role('Customer')->get();
            foreach ($customers as $customer) {
                $customer->notify(new UserNotification($title, $message));
            }
        }
        
        // Send to non-registered users if selected
        if (true) {
            $data = [
                'title' => $title,
                'message' => $message,
                'created_at' => now(),
                'updated_at' => now()
            ];
            
            // Store in guest notifications table
            DB::table('guest_notifications')->insert($data);
        }

        return redirect()->route('admin.notification')->with('success', 'Notification sent successfully.');
    }
}