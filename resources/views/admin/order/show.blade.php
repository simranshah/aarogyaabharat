@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Order Details</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order #{{ $order->id }}</h3>
            </div>
            <div class="card-body">
                <!-- Order Amount & Status -->
                <h5>Order Information</h5>
                <p><strong>Amount:</strong> ₹{{ number_format($order->amount, 0) }}</p>
                <p><strong>Status:</strong> {{ $order->status->name }}</p>
                <p><strong>Created At:</strong> {{ $order->created_at }}</p>
                <!-- Customer Information -->
                 <hr/>
                 <br/>
                <h5>Customer Information</h5>
                <p><strong>Name:</strong> {{ $order->customer->name }}</p>
                <p><strong>Email:</strong> {{ $order->customer->email }}</p>
                <p><strong>Mobile:</strong> {{ $order->customer->mobile }}</p>
                <p><strong>City:</strong> {{ $order->customer->city }}</p>
                <p><strong>Pincode:</strong> {{ $order->customer->pincode_id }}</p>
                <hr/>
                 <br/>

                <!-- Order Address -->
                <h5>Shipping Address</h5>
               @if(isset($order->orderAddress->house_number)) <p><strong>House Number:</strong> {{ $order->orderAddress->house_number }}</p>@endif
                <p><strong>Society Name:</strong> {{ $order->orderAddress->society_name }}</p>
                <p><strong>Landmark:</strong> {{ $order->orderAddress->landmark }}</p>
                <p><strong>Pincode:</strong> {{ $order->orderAddress->pincode }}</p>
                <p><strong>City:</strong> {{ $order->orderAddress->city }}</p>
                <p><strong>State:</strong> {{ $order->orderAddress->state ?? 'N/A' }}</p>
                <hr/>
                 <br/>    
                <!-- Order Items -->
                <h5>Order Items</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sub Total</th>
                            <th>GST</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                            $gstTotal = 0;
                            $offerAmount = 0;
                        @endphp
                        @foreach ($order->orderItems as $item)
                            @php
                                // Calculate Subtotal for each item
                                $subTotal = $item->price * $item->quantity;
                                
                                // Assuming each product has a `gst` field in your `Product` model
                                $gst = ($subTotal * $item->product->gst / 100);
                                $total += $subTotal + $gst;
                                
                                // Assuming there's an offer that you can apply
                                $offerAmount += $order->offer_amount ?? 0;
                                
                                $gstTotal += $gst; 
                            @endphp
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₹{{ number_format($item->price, 2) }}</td>
                                <td>₹{{ number_format($subTotal, 2) }}</td>
                                <td>₹{{ number_format($gst, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr/>
                <br/>
                @php 
                if(!empty($order->orderOffer)) {
                                if($order->orderOffer->type == 'amount') {
                                    $offerAmount = $order->orderOffer->value;
                                } else {
                                    
                                }
                }
                @endphp
                <!-- Calculation Section -->
                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Summary</h5>
                        <p><strong>Subtotal:</strong> ₹{{ number_format($total - $gstTotal, 2) }}</p>
                        <p><strong>GST:</strong> ₹{{ number_format($gstTotal, 2) }}</p>
                        <p><strong>Offer Amount:</strong> ₹{{ number_format($offerAmount, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Final Total</h5>
                        <p><strong>Total:</strong> ₹{{ number_format($total - $offerAmount, 2) }}</p>
                    </div>
                </div>
                <hr/>
                <br/>   
                <!-- Status Update Form -->
                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="status_id">Change Status</label>
                        <select name="status_id" id="status_id" class="form-control">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" {{ $status->id == $order->status_id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back to Orders</a>
            </div>
        </div>
    </section>
</div>
@endsection

