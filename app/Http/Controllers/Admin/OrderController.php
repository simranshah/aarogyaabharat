<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Order; 
use App\Models\Admin\Status; 
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
            if ($request->ajax()) {
            $orders = Order::with(['customer', 'status']) 
                ->select('id', 'customer_id', 'amount', 'status_id', 'created_at');

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    return '
                        <a href="' . route('admin.order.edit', $order->id) . '" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="' . route('admin.order.show', $order->id) . '" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>';
                })
                ->editColumn('created_at', function ($order) {
                    return $order->created_at->format('Y-m-d H:i'); // Format date as needed
                })
                ->make(true);
        }

        return view('admin.order.index'); 
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'status', 'orderAddress', 'orderItems.product', 'orderOffer'])->findOrFail($id);
        // dd($order);
        $statuses = Status::all();  
        return view('admin.order.show', compact('order', 'statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:status,id',
        ]);

        $order = Order::findOrFail($id);
        $order->status_id = $request->status_id;
        $order->save();

        return redirect()->route('admin.order.show', $order->id)
            ->with('success', 'Order status updated successfully.');
    }
}
