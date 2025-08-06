<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function index() {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Customer', 'Admin']);
        })->get();
        
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        // dd($roles);
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);
        
        // Send welcome email only for customers
        if ($request->role === 'Customer') {
            try {
                Mail::to($user->email)->send(new WelcomeEmail($user));
            } catch (\Exception $e) {
                \Log::error('Failed to send welcome email: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $userRole = $user->getRoleNames()->first();
        return view('admin.user.edit', compact('roles', 'user', 'userRole'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'role' => 'required|string|exists:roles,name'
    ]);

    $user->name = $validated['name'];
    $user->email = $validated['email'];

    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    $user->syncRoles($validated['role']);

    return redirect()->route('admin.users')->with('success', 'User updated successfully');
}

    
}
