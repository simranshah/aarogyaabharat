
<div class="orderplacedPop winScrollStop">
                   
  
 <div class="orderplacedPopInner">
    <a href="#;"><img src="images/cross.svg" alt="" /> </a>
    <div class="orderTtl">
        <strong>Order Placed Successfully.</strong>
        <p>Confirmation will be sent to your e-mail.</p>
    </div>
    <div class="orderedProduct">
        <div class="imagePart">
            <img src="images/wheelchair_1.png" alt="" />
        </div>
        <div class="productadd">
            <strong>Shipping to {{ $address->customer->name ?? 'N/A' }}</strong> <!-- Customer name -->
            <p>{{ $address->house_number ?? '' }}, {{ $address->society_name ?? '' }}, {{ $address->landmark ?? '' }}, {{ $address->locality ?? '' }}</p>
            <p>{{ $address->city ?? '' }} - {{ $address->pincode ?? '' }}, {{ $address->state ?? '' }}</p>
            <p>Phone number: {{ $address->customer->phone ?? 'N/A' }}</p> <!-- Assuming the customer has a phone number -->
        </div>
    </div>
    <div class="btnPart">
        <a href="{{ route('home') }}" class="goHomeBtn">Go to Home</a>
        <a href="#;" class="shreI"><img src="images/Share.svg" alt="" /></a>
    </div>
</div>
