<div class="order-info-container">
    @forelse ($customerDetail as $orderGroup)
        <div class="order-info-order-card">
            <div class="order-info-order-header">
                <span class="order-info-order-id">Order ID: {{ $orderGroup['order_data']->id ?? 'N/A' }}</span>
                <div>
                    <span class="order-info-order-date">
                        Date: {{ isset($orderGroup['order_data']->created_at) ? \Carbon\Carbon::parse($orderGroup['order_data']->created_at)->format('d-m-Y') : 'N/A' }}
                    </span>
                  
                </div>
            </div>
            
            <div class="order-info-delivery-info">
                Arriving in 4-7 days. We appreciate your patience
            </div>
            
            @foreach ($orderGroup['cancel_products'] ?? [] as $cancelItem)
                @php
                    $product = $cancelItem->orderItems->product ?? null;
                @endphp
                
                <div class="order-info-product-item">
                    <div class="order-info-product-image">
                        @if($product && isset($product->image))
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name ?? 'Product Image' }}" style="width: 100%; height:100%;">
                        @else
                            <img src="{{ asset('front/images/default_image.png') }}" alt="Default Image">
                        @endif
                    </div>
                    
                    <div class="order-info-product-details">
                        <div class="order-info-product-name">
                            {{ $product->name ?? 'Product name not available' }}
                        </div>
                        <div class="order-info-product-price">
                            Rs {{ $product->our_price ?? '0.00' }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="no-orders-message">
            No orders with canceled items found.
        </div>
    @endforelse
</div>