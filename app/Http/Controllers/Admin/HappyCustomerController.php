<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HappyCustomer;
use App\Models\Admin\PinOffice;
use Illuminate\Http\Request;
use DataTables;

class HappyCustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = HappyCustomer::all(); // Adjust to your needs

            return DataTables::of($customers)
                ->addColumn('action', function ($customer) {
                    return '<a href="' . route('admin.happy.customers.edit', $customer->id) . '" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="' . route('admin.happy.customers.destroy', $customer->id) . '" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>';
                })
                ->make(true);
        }

        return view('admin.happy-customers.index');
    }

    public function create()
    {
        $pins = PinOffice::get();
        return view('admin.happy-customers.create' , compact('pins'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rate' => 'required|integer|between:1,5', // Assuming a rating scale of 1-5
            'city' => 'required',
            'state' => 'required',
        ]);

        HappyCustomer::create($request->all());
        return redirect()->route('admin.happy.customers')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = HappyCustomer::findOrFail($id);
        $pins = PinOffice::get();
        return view('admin.happy-customers.edit', compact('customer', 'pins'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rate' => 'required|integer|between:1,5',
            'city' => 'required',
            'state' => 'required'
        ]);

        $customer = HappyCustomer::findOrFail($id);
        $customer->update($request->all());
        return redirect()->route('admin.happy.customers')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = HappyCustomer::findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.happy.customers')->with('success', 'Customer deleted successfully.');
    }
}
