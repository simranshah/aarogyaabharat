<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = User::with('addresses')
            ->whereHas('roles', function($query) {
                $query->where('name', 'Customer');
            })
            ->get();

            return DataTables::of($customers)
                ->addColumn('action', function ($customer) { // Add parentheses around the parameter
                    // return '<a href="' . route('admin.customers.edit', $customer->id) . '" class="btn btn-sm btn-primary">
                    //             <i class="fas fa-edit"></i>
                    //         </a>
                    //         <a href="' . route('admin.customers.destroy', $customer->id) . '" class="btn btn-sm btn-danger">
                    //             <i class="fas fa-trash"></i>
                    //         </a>
                    return '<a href="' . route('admin.customers.view', $customer->id) . '" class="btn btn-sm btn-success">
                                <i class="fas fa-eye"></i>
                            </a>';
                })
                ->make(true);
        }

        return view('admin.customers.index');
    }

    public function edit($id)
    {
        $customer = User::with('addresses')->findOrFail($id); 
        return view('admin.customers.edit', compact('customer'));
    }

    public function show($id)
    {
        $customer = User::with('addresses')->findOrFail($id);
        return view('admin.customers.show', compact('customer'));
    }

    
}
