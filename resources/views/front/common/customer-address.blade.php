@if($customerDetail->addresses && $customerDetail->addresses->isNotEmpty())
    @foreach($customerDetail->addresses as $address)
        <div class="deliveryAddressInner">
            <label class="deliveryAddress1">
            <input type="radio" onclick="chnagedeliveryadress({{$address->id}});" name="addressRadio" value="{{ $address->id }}" {{ $address->is_delivery_address ? 'checked' : '' }}>
                <span></span>
                <div>
                    <strong>{{ $customerDetail->name }}</strong>
                    <p>
                        {{ $address->house_number ? $address->house_number . ',' : '' }}
                        {{ $address->society_name ? $address->society_name . ',' : '' }}
                        {{ $address->locality ? $address->locality . ',' : '' }}
                        {{ $address->landmark ? $address->landmark . ',' : '' }}
                        {{ $address->pincode ? $address->pincode . ',' : '' }}
                        {{ $address->city ? $address->city : '' }}
                        {{ $address->state ? $address->state : '' }}
                    </p> 
                </div>
            </label>
            <div class="edit_remove">
                <a href="#;" onclick="editAddress({{ $address->id }})" class="edit_box">Edit</a>
                <a href="#" class="remove_box" onclick="removeAddress({{ $address->id }})" data-address-id="{{ $address->id }}">Remove</a>
            </div>
        </div>
    @endforeach
@else
    <p>No delivery addresses available.</p>
@endif
<script>
    function chnagedeliveryadress(selectedId){
        if (!selectedId) {
        alert("Please select an address.");
        return;
    }

    $.ajax({
        url: '/change-deliver-adress', // Laravel route URL (web.php or route name with URL helper)
        type: 'POST',
        data: {
            address_id: selectedId,
            _token: $('meta[name="csrf-token"]').attr('content') // Laravel CSRF token
        },
        success: function(response) {
            // location.reload();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
    }
</script>