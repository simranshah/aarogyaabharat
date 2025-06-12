
    {{-- @foreach($customerDetail->orders as $order) --}}
        @if($customerDetail)
        @php
           
        @endphp
            @foreach($customerDetail as $orderItem)
                <div class="order_info_box">
                    <div class="order_product">
                        @if( $orderItem->orderItems->product && $orderItem->orderItems->product->image)
                            <img src="{{ asset('storage/'. $orderItem->orderItems->product->image) }}" alt="Product Image">
                        @else
                            <img src="{{ asset('front/images/default_image.png') }}" alt="Default Image">
                        @endif
                    </div>
                    <div class="order_info_text">
                        <div style="display: flex; align-items: center; ">
                            <h2 >
                                {{ $orderItem->orderItems->product->name ?? 'Product name not available' }}
                            </h2>
                            {{-- <p>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</p> --}}
                        </div>
                        {{-- <h2>
                            {{ $orderItem->product->name ?? 'Product name not available' }} <!-- Display product name -->
                        </h2>
                        <p>Order Date:{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</p>
                        </div> --}}
                          <p>Price: {{$orderItem->orderItems->product->our_price}} &nbsp;&nbsp; Qty: {{$orderItem->qty}}</p>
                          
                         @if ($orderItem->status_id=='2')
                        <p>Arriving in 4-7 days. We appreciate your patience!</p>
                            {{-- {{ \Carbon\Carbon::parse($order->delivery_date)->format('d-m-Y') }} --}}
                        {{-- </p?> --}}
                        @endif
                        <span>{{ $orderItem->status->name ?? 'Status not available' }}</span> <!-- Display order status -->
                        <div class="cancel_share">
                            @if ($orderItem->status_id=='2' || $orderItem->status_id=='6')
                            <a href="#;" class="cancel_click" onclick="showcanelpopup('{{$orderItem->id}}','{{$orderItem->quantity}}')">Remove Item</a>
                            <a href="#;"><img src="{{ asset('front/images/Share.svg') }}" alt="Share" /></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No products available for this order.</p>
        @endif
    {{-- @endforeach --}}
<script>
    function showcanelpopup(productid,qyt) {
    // console.log("Address ID received:", addressid); // Debug log
    document.getElementById('areyousurePop').style.display = 'flex';
    document.getElementById('qtyInput').max = qyt;
    document.getElementById('cancelorder').onclick = function() { 
        // console.log("Button clicked, passing address ID:", addressid); // Debug log
        cancelWithId(productid); 
    };
}
function  cancelWithId(productid){
     var qyttoremove=document.getElementById('qtyInput').value;
    $.ajax({  
            url: '/customer/remove-order-item/' + productid,
            data: { qytToRemove: qyttoremove },
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    //  toastr.success(response.message);
                    location.reload();
                   
                } else {
                     document.getElementById('logoutPopup3').style.display='flex';
                    // toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                 document.getElementById('logoutPopup3').style.display='flex';
                // toastr.error('Something went wrong. Please try again.');
            }
        });
}
</script>
