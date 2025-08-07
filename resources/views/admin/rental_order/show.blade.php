@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Rental Order Details</h1>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rental Order #{{ $rentalOrder->id }}</h3>
            </div>
            <div class="card-body">
                <!-- Rental Order Info -->
                <h5>Order Information</h5>
                <p><strong>Amount:</strong> ₹{{ number_format($rentalOrder->total_amount, 2) }}</p>
                {{-- <p><strong>Status:</strong> {{ $rentalOrder->status ? $rentalOrder->status->name : ucfirst($rentalOrder->status) }}</p> --}}
                <p><strong>Created At:</strong> {{ $rentalOrder->created_at }}</p>
                <hr/>
                <!-- Customer Info -->
                <h5>Customer Information</h5>
                <p><strong>Name:</strong> {{ $rentalOrder->user->name ?? '' }}</p>
                <p><strong>Email:</strong> {{ $rentalOrder->user->email ?? '' }}</p>
                <hr/>
                <!-- Rental Address -->
                @if($rentalOrder->rentalAddress)
                <h5>Rental Address</h5>
                <p><strong>Address:</strong> {{ $rentalOrder->rentalAddress->address ?? '' }}</p>
                <p><strong>City:</strong> {{ $rentalOrder->rentalAddress->city ?? '' }}</p>
                <p><strong>Pincode:</strong> {{ $rentalOrder->rentalAddress->pincode ?? '' }}</p>
                <hr/>
                @endif
                <!-- Rental Items -->
                <h5>Rental Items</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Tenure</th>
                            <th>Monthly Rent</th>
                            <th>Total Rent</th>
                            <th>Deposit</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentalOrder->rentalProducts as $item)
                        <tr>
                            <td>{{ $item->product->name ?? '' }}</td>
                            <td>{{ $item->tenure }}</td>
                            <td>₹{{ number_format($item->monthly_rent, 2) }}</td>
                            <td>₹{{ number_format($item->total_rent, 2) }}</td>
                            <td>₹{{ number_format($item->deposit_amount, 2) }}</td>
                            <td>
                                <select name="status_id" class="form-control" onchange="changeRentalItemStatus({{ $item->id }}, this.value)">
                                    <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}   >Completed</option>
                                    <option value="cancelled" {{ $item->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="overdue" {{ $item->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                    <option value="placed" {{ $item->status == 'placed' ? 'selected' : '' }}>Placed</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr/>
                <!-- Order Summary -->
                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Summary</h5>
                        <p><strong>Base Amount:</strong> ₹{{ number_format($rentalOrder->base_amount, 2) }}</p>
                        <p><strong>GST:</strong> ₹{{ number_format($rentalOrder->gst_amount, 2) }}</p>
                        <p><strong>Delivery Fees:</strong> ₹{{ number_format($rentalOrder->delivery_fees, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Final Total</h5>
                        <p><strong>Total:</strong> ₹{{ number_format($rentalOrder->total_amount, 2) }}</p>
                    </div>
                </div>
                <hr/>
                <!-- Status Update Form for Whole Order (optional) -->
                <form action="{{ route('admin.rental_order.updateStatus', $rentalOrder->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="status_id">Change Order Status</label>
                        <select name="status_id" id="status_id" class="form-control">
                           <option value="pending" {{ $rentalOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                           <option value="completed" {{ $rentalOrder->status == 'completed' ? 'selected' : '' }}   >Completed</option>
                           <option value="cancelled" {{ $rentalOrder->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                           <option value="failed" {{ $rentalOrder->status == 'failed' ? 'selected' : '' }}>Failed</option>
                           {{-- <option value="cancelled" {{ $rentalOrder->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option> --}}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.rental_order.index') }}" class="btn btn-secondary">Back to Rental Orders</a>
            </div>
        </div>
    </section>
</div>
<script>
function changeRentalItemStatus(itemId, statusId) {
    $.ajax({
        url: '/admin/rental-orders/update-order-item-status/' + itemId + '/' + statusId,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Failed to update status');
            }
        },
        error: function() {
            alert('Error updating status');
        }
    });
}
</script>
@endsection