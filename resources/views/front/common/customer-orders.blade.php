@if(isset($customerDetail->orders) && $customerDetail->orders && $totalOrderItems > 0)
    <div class="order-info-container" id='orderinfoid'>
        <!-- Order 1 -->
        @foreach ($customerDetail->orders as $orders)
        @if($orders->item_count > 0)

        <div class="order-info-order-card"
            >
            <div class="order-info-order-header">
                <span class="order-info-order-id">Order ID: {{$orders->id}}</span>
                <div>
                    <span class="order-info-order-date">Date: {{ \Carbon\Carbon::parse($orders->created_at)->format('d-m-Y') }}</span>
                    <span class="order-info-order-status">{{$orders->status->name}}</span>
                </div>
            </div>
            @if($statusId==2)
            <div class="order-info-delivery-info">  
                Arriving in 4-7 days. We appreciate your patience
            </div>
            @endif
            @foreach ($orders->orderItems as $orderItems)
            @if($orderItems->quantity>0)
            <div class="order-info-product-item">
                <div class="order-info-product-image">
                         @if(  $orderItems->product &&  $orderItems->product->image)
                            <img src="{{ asset('storage/'. $orderItems->product->image) }}" alt="Product Image" style="width: 100%; height:100%;">
                        @else
                            <img src="{{ asset('front/images/default_image.png') }}" alt="Default Image">
                        @endif

                </div>
                <div class="order-info-product-details">
                    <div class="order-info-product-name">  {{ $orderItems->product->name ?? 'Product name not available' }}</div>
                    <div class="order-info-product-price">Rs {{ $orderItems->product->our_price + (($orderItems->product->our_price * $orderItems->product->gst)/100)+ $orderItems->product->delivery_and_installation_fees}}</div>
                </div>
                <button class="order-info-cancel-btn"
                 onclick="openorderdetails({{$orders->id}});"
            data-index="{{$loop->index}}"
            data-product-id="{{ $orders->id }}"
                >
                @if($statusId==2)
                Cancel Item
                @else
                Return Item
                @endif
            </button>
            </div>
            @endif
            @endforeach
        </div>
        @endif
        @endforeach
    </div>
@else
@if($statusId==2)
<p>No orders placed yet. <a href="{{url('/')}}"> Start shopping </a> to place your first order!</p>
@else
<p>No delivered orders found.</p>
@endif
@endif
<script>
    function openorderdetails(orderid){
        // openModal();
      $.ajax({
        url: '/get-order-data/'+orderid, // Laravel route URL (web.php or route name with URL helper)
        success: function(response) {
            // location.reload();
            document.getElementById('modalOverlay').innerHTML = response.html;
            openModal();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
    }
</script>
