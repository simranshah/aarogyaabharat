@if($customerDetail && $customerDetail->orders->isNotEmpty())
    @foreach($customerDetail->orders as $order)
        @if($order->orderItems->isNotEmpty())
            @foreach($order->orderItems as $orderItem)
                <div class="order_info_box">
                    <div class="order_product">
                        @if($orderItem->product && $orderItem->product->image)
                            <img src="{{ asset('storage/'.$orderItem->product->image) }}" alt="Product Image">
                        @else
                            <img src="{{ asset('front/images/default_image.png') }}" alt="Default Image">
                        @endif
                    </div>
                    <div class="order_info_text">
                        <h2>
                            {{ $orderItem->product->name ?? 'Product name not available' }} <!-- Display product name -->
                        </h2>
                        <p>Your product delivery will be on {{ \Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y') }}</p>
                        <span>{{ $order->status->name ?? 'Status not available' }}</span> <!-- Display order status -->
                        <div class="cancel_share">
                            <a href="#;" class="cancel_click" data-order-id="{{ $order->id }}">Cancel Order</a>
                            <a href="#;"><img src="{{ asset('front/images/Share.svg') }}" alt="Share" /></a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No products available for this order.</p>
        @endif
    @endforeach
@else
    <p>No orders available.</p>
@endif
