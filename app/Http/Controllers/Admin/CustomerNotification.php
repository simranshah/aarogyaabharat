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
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;

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
    // Validate the type selection first
    $validated = $request->validate([
        'type' => 'required|array|min:1',
        'type.*' => 'in:notification,email'
    ]);

    // Initialize variables
    $title = null;
    $message = null;
    $emailSubject = null;
    $emailBody = null;

    // Conditional validation and data assignment
    if (in_array('notification', $request->type)) {
        $notificationData = $request->validate([
            'title' => 'required|string|max:100',
            'message' => 'required|string|max:255',
        ]);
        $title = $notificationData['title'];
        $message = $notificationData['message'];
    }

    if (in_array('email', $request->type)) {
        $emailData = $request->validate([
            'email_subject' => 'required|string|max:100',
            'email_body' => 'required|string',
        ]);
        $emailSubject = $emailData['email_subject'];
        $emailBody = $emailData['email_body'];
    }

    // Get all customers
    $customers = User::get();

    // Process notifications and emails
    foreach ($customers as $customer) {
        // Send notification if selected
        if (in_array('notification', $request->type)) {
            $customer->notify(new UserNotification($title, $message));
        }

        // Send email if selected
        if (in_array('email', $request->type)) {
            Mail::to($customer->email)->send(new NotificationEmail(
                $emailSubject,
                $emailBody
            ));
        }
    }

    // If you still want to store guest notifications (for non-registered users)
    if (in_array('notification', $request->type)) {
        DB::table('guest_notifications')->insert([
            'title' => $title,
            'message' => $message,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    return redirect()->route('admin.notification')
        ->with('success', 'Notifications sent successfully.');
}
}