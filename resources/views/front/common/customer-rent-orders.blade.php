@if(isset($rentalOrderGroups) && count($rentalOrderGroups) > 0)
    <div class="new-order-info-container" id='rentinfoid'>
        @foreach($rentalOrderGroups as $rentalOrderGroup)
            <div class="new-order-info-order-card">
                <div class="new-order-info-order-header">
                    <span class="new-order-info-order-id">Rental Order ID: {{ $rentalOrderGroup['rental_order_id'] }}</span>
                    <div>
                        <span class="new-order-info-order-date">Date: {{ $rentalOrderGroup['order_date']->format('d-m-Y') }}</span>
                        @if($rentalOrderGroup['is_overdue'])
                            <span class="new-order-info-order-status" style="color: #dc3545;">Overdue</span>
                        @elseif($status === 'active')
                            <span class="new-order-info-order-status" style="color: #28a745;">Active</span>
                        @else
                            <span class="new-order-info-order-status" style="color: #0c5460;">Completed</span>
                        @endif
                    </div>
                </div>
                @if($rentalOrderGroup['next_payment_date'] && $rentalOrderGroup['next_payment_date']->diffInDays(now()) <= 7)
                <div class="new-order-info-delivery-info">  
                    Payment due in {{ $rentalOrderGroup['next_payment_date']->diffInDays(now()) }} days. Please make your payment on time.
                </div>
                @endif
                @foreach($rentalOrderGroup['products'] as $rentalProduct)
                <div class="new-order-info-product-item">
                    <div class="new-order-info-product-image">
                        @if($rentalProduct->product && $rentalProduct->product->image)
                            <img src="{{ asset('storage/'. $rentalProduct->product->image) }}" alt="Product Image" style="width: 100%; height:100%;">
                        @else
                            <img src="{{ asset('front/images/default_image.png') }}" alt="Default Image">
                        @endif
                    </div>
                    <div class="new-order-info-product-details">
                        <div class="new-order-info-product-name">{{ $rentalProduct->product->name ?? 'Product name not available' }}</div>
                        <div class="new-order-info-product-price">
                            Monthly Rent: ₹{{ number_format($rentalProduct->monthly_rent, 2) }}<br>
                            @if($rentalProduct->next_payment_date)
                                @if($rentalProduct->is_overdue)
                                    <span style="color: #dc3545;">Overdue since: {{ $rentalProduct->next_payment_date->format('d-m-Y') }}</span>
                                @else
                                    <span style="color: #28a745;">Next payment: {{ $rentalProduct->next_payment_date->format('d-m-Y') }}</span>
                                @endif
                            @endif
                        </div>
                    </div>
                    @if($rentalProduct->next_payment_date && ($rentalProduct->is_overdue || $rentalProduct->next_payment_date->diffInDays(now()) <= 7))
                        <button class="new-order-info-cancel-btn" style="color:white; background-color: #ff7529;"
                           onclick="processPayment({{ $rentalProduct->id }})"
                            data-index="{{$loop->index}}"
                            data-rental-id="{{ $rentalOrderGroup['rental_order_id'] }}"
                            data-product-id="{{ $rentalProduct->id }}"
                            data-due-date="{{ $rentalProduct->next_payment_date->format('Y-m-d') }}"
                        >
                            @if($rentalProduct->is_overdue)
                                Pay Overdue
                            @else
                                Pay Now
                            @endif
                        </button>
                    @else
                        <div class="new-order-info-status-info" style="color: #28a745; font-size: 14px; font-weight: 500;">
                            Payment Up to Date
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        @endforeach
    </div>
@else
    <div class="new-no-orders">
        <div class="new-no-orders-content">
            <img src="{{ asset('front/images/no_rentals.svg') }}" alt="No Rentals" class="new-no-orders-image">
            <h3>No {{ ucfirst($status) }} Rentals</h3>
            <p>
                @if($status === 'active')
                    You don't have any active rental orders at the moment.
                @elseif($status === 'completed')
                    You don't have any completed rental orders.
                @elseif($status === 'overdue')
                    Great! You don't have any overdue rental payments.
                @endif
            </p>
            <a href="{{ route('products') }}" class="new-browse-products-btn">Browse Products</a>
        </div>
    </div>
@endif

<style>
.new-order-info-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.new-order-info-order-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow: hidden;
}

.new-order-info-order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
}

.new-order-info-order-id {
    font-weight: 600;
    color: #333;
    font-size: 16px;
}

.new-order-info-order-date {
    color: #666;
    font-size: 14px;
    margin-right: 15px;
}

.new-order-info-order-status {
    font-weight: 600;
    font-size: 14px;
    padding: 4px 8px;
    border-radius: 12px;
    background: #e9ecef;
}

.new-order-info-delivery-info {
    background: #fff3cd;
    color: #856404;
    padding: 10px 20px;
    font-size: 14px;
    border-left: 4px solid #ffc107;
}

.new-order-info-product-item {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
}

.new-order-info-product-item:last-child {
    border-bottom: none;
}

.new-order-info-product-image {
    width: 80px;
    height: 80px;
    margin-right: 15px;
    border-radius: 8px;
    overflow: hidden;
}

.new-order-info-product-details {
    flex: 1;
}

.new-order-info-product-name {
    font-weight: 600;
    color: #333;
    font-size: 16px;
    margin-bottom: 5px;
}

.new-order-info-product-price {
    color: #666;
    font-size: 14px;
    line-height: 1.4;
}

.new-order-info-cancel-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.new-order-info-cancel-btn:hover {
    background-color: #e65a1a !important;
}

.new-order-info-cancel-btn:disabled {
    background-color: #6c757d !important;
    cursor: not-allowed;
}

.new-order-info-status-info {
    padding: 8px 16px;
    border-radius: 6px;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
}

.new-no-orders {
    text-align: center;
    padding: 40px 20px;
}

.new-no-orders-content {
    max-width: 400px;
    margin: 0 auto;
}

.new-no-orders-image {
    width: 120px;
    height: 120px;
    margin-bottom: 20px;
    opacity: 0.6;
}

.new-no-orders h3 {
    color: #333;
    margin: 0 0 10px 0;
    font-size: 20px;
}

.new-no-orders p {
    color: #666;
    margin: 0 0 20px 0;
    line-height: 1.5;
}

.new-browse-products-btn {
    display: inline-block;
    background: #ff7529;
    color: white;
    padding: 12px 24px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.2s;
}

.new-browse-products-btn:hover {
    background: #e65a1a;
    color: white;
    text-decoration: none;
}
</style>
