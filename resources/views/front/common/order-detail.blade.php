<div class="order-info-pop-upmodal-container">
            <div class="order-info-pop-upmodal-header">
                <h2 class="order-info-pop-upmodal-title">Cancel Items</h2>
                <button class="order-info-pop-upclose-button" onclick="closeModal()">&times;</button>
            </div>
            
            <div class="order-info-pop-upmodal-content">
                <div class="order-info-pop-upleft-section">
                    @foreach ($order->orderItems as $orderItem)
                    <div class="order-info-pop-upitem-card" 
     onclick="toggleItem(this, '{{$loop->index}}')" 
     data-index="{{$loop->index}}" 
     data-product-id="{{ $orderItem->id }}"
     data-max-qty="{{ $orderItem->quantity }}">
                        <div class="order-info-pop-upcheckbox-container">
                            <div class="order-info-pop-upcheckbox" id="checkbox-{{$loop->index}}">
                            </div>
                        </div>
                        <div class="order-info-pop-upproduct-image">
                             @if(  $orderItem->product &&  $orderItem->product->image)
                            <img src="{{ asset('storage/'. $orderItem->product->image) }}" alt="Product Image" style="width: 100%; height:100%;">
                        @else
                            <img src="{{ asset('front/images/default_image.png') }}" alt="Default Image">
                        @endif
                        </div>
                        <div class="order-info-pop-upproduct-info">
                            <div class="order-info-pop-upproduct-name">{{$orderItem->product->name}}</div>
                            <div class="order-info-pop-upproduct-qty">QTY : {{$orderItem->quantity}}</div>
                            <div class="order-info-pop-upquantity-controls">
                                <button class="order-info-pop-upqty-btn" onclick="changeQuantity(event, '{{$loop->index}}', -1)">-</button>
                                <span class="order-info-pop-upqty-number" id="qty-{{$loop->index}}">{{$orderItem->quantity}}</span>
                                <button class="order-info-pop-upqty-btn" onclick="changeQuantity(event, '{{$loop->index}}', 1)">+</button>
                            </div>
                        </div>
                        <div class="order-info-pop-upproduct-price">Rs {{ $orderItem->product->our_price}}</div>
                    </div>
                    @endforeach
                </div>

                <div class="order-info-pop-upright-section">
                    <div class="order-info-pop-upreason-title">Cancellation reason</div>
                    
                    <div class="order-info-pop-updropdown">
                        <button class="order-info-pop-updropdown-button">
                            <span>Select reason</span>
                            <span class="order-info-pop-updropdown-icon">✓</span>
                        </button>
                    </div>

                    <div class="order-info-pop-uprefund-option">
                        <div class="order-info-pop-upradio-container">
                            <input type="radio" name="refund" class="order-info-pop-upradio-input" checked>
                            <div class="order-info-pop-upradio-content">
                                <div class="order-info-pop-uprefund-method">Refund to original payment instrument</div>
                                <div class="order-info-pop-uprefund-timeline">within 3-5 business days of order cancellation</div>
                            </div>
                        </div>
                    </div>

                    <button class="order-info-pop-upcancel-button" onclick="cancelItems()">Cancel checked items</button>
                </div>
            </div>
        </div>