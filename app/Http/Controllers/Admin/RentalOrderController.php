<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalOrder;
use App\Models\RentalProduct;
use App\Models\Admin\Status;
use Yajra\DataTables\DataTables;

class RentalOrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rentalOrders = RentalOrder::with(['user'])
                ->select('id', 'user_id', 'total_amount', 'status', 'created_at');

            return DataTables::of($rentalOrders)
                ->addColumn('action', function ($rentalOrder) {
                    return '
                        <a href="' . route('admin.rental_order.show', $rentalOrder->id) . '" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>';
                })
                ->editColumn('created_at', function ($rentalOrder) {
                    return $rentalOrder->created_at->format('Y-m-d H:i');
                })
                ->make(true);
        }

        return view('admin.rental_order.index');
    }

    public function show($id)
    {
        $rentalOrder = RentalOrder::with(['user', 'rentalAddress', 'rentalProducts.product'])->findOrFail($id);
        $statuses = Status::all();
        return view('admin.rental_order.show', compact('rentalOrder', 'statuses'));
    }

    public function updateOrderItemStatus($itemId, $statusId)
    {
        $item = RentalProduct::findOrFail($itemId);
        $item->status = $statusId;
        $item->save();
        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required',
        ]);
        $rentalOrder = RentalOrder::findOrFail($id);
        $rentalOrder->status = $request->status_id;
        $rentalOrder->save();
        return redirect()->route('admin.rental_order.show', $rentalOrder->id)
            ->with('success', 'Rental order status updated successfully.');
    }
}