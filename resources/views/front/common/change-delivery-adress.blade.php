<div class="delivery-popup" id="deliveryPopup">
    <div class="delivery-content">
      <span class="close-popup" onclick="closePopup()">×</span>
      <div class="delivery-header">
        {{-- <img src="/front/images/pin.svg" alt="Location" class="location-icon" /> --}}
        <span style="font-weight: bold;">Select your delivery address</span>
      </div>
      
      @php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
@if($customerDetail)
@foreach($customerDetail->addresses as $address)
                            @php 
                            $fullAddress = 
                                ($address->house_number ? $address->house_number . ', ' : '') .
                                ($address->society_name ? $address->society_name . ', ' : '') .
                                ($address->locality ? $address->locality . ', ' : '') .
                                ($address->landmark ? $address->landmark . ', ' : '') .
                                ($address->pincode ? $address->pincode . ', ' : '') .
                                ($address->city ? $address->city . ', ' : '') .
                                ($address->state ? $address->state : '');

                                  // Optionally remove trailing comma and space
                                 $fullAddress = rtrim($fullAddress, ', ');                                
                            @endphp
      <ul class="address-list">
        <li>
          <label>
            <input type="radio" name="delivery-address" value="{{ $address->id }}" {{ $address->is_delivery_address ? 'checked' : '' }}>
            @if($address->name!='')
            <span>{{ $address->name }}</span>
          @else 
            <span>{{ Auth::user()->name }}</span>  
          @endif
          <br>
           {{$fullAddress}}
          
          @if($address->mobile!='')
         <p> Mobile:{{ $address->mobile }}</p>
          @else
         <p>Mobile:{{ Auth::user()->mobile }}</p>
          @endif
        </label>
          
          <a href="javascript:void(0);" class="edit-address-link" onclick="editAddress('{{ $address->id }}')">Edit Address</a>
        </li>

      </ul>
      @if($customerDetail->addresses->count() != $loop->last)
      <hr class="divider" />
      @endif
        @endforeach
        @endif
      <div class="footer-actions">
        <button class="cancel-btn" onclick="addnewadress()">Add New Address</button>
        <button class="confirm-btn" onclick="sendSelectedAddress()">Confirm</button>
      </div>
    </div>
  </div>
  <script>
function addnewadress() {
  
  $('.addressFormPop').hide();
  addNewDeliveryAddress1();
}
    function closePopup() {
        const popup = document.querySelector('.addressFormPop');
    if (popup) {
      popup.style.display = 'none';
    }
    }
  
    function sendSelectedAddress() {
    const selectedId = $('input[name="delivery-address"]:checked').val();

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
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
  
}
function editAddress(id) {
    $.ajax({
        url: '/customer/get-update-address/' + id,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                $('.addressFormPop').html(response.html);
                $('#addressForm input[name="house_number"]').val(response.address.house_number);
                    $('#addressForm input[name="society_name"]').val(response.address.society_name);
                    $('#addressForm input[name="landmark"]').val(response.address.landmark);
                    $('#addressForm input[name="pincode"]').val(response.address.pincode);
                    $('#addressForm input[name="city"]').val(response.address.city);
                    $('#addressForm input[name="state"]').val(response.address.state);
                    $('#addressForm input[name="delivery"]').prop('checked', response.address.is_delivery_address);
                    $('#addressForm input[name="uuid"]').val(id);
                    $('#addressForm input[name="mobile"]').val(response.address.mobile);
                    $('#addressForm input[name="name"]').val(response.address.name);
               $('.addressFormPop').show();
               
            } else {
                 document.getElementById('logoutPopup3').style.display='flex';
                // toastr.error('Error fetching address data.');
            }
        },
        error: function(xhr, status, error) {
             document.getElementById('logoutPopup3').style.display='flex';
            // toastr.error('Something went wrong while fetching the address data.');
        }
    });
}

function updateAddress(event) {
        event.preventDefault(); 

        if (!$('#DA').prop('checked')) {
                $('#DA').val('0');
                } else {
                    // If checked, ensure the value is 1 (it should already be by default)
                    $('#DA').val('1');
                }
                // Collect form data
        var formData = {
            house_number: $("#addressForm input[name='house_number']").val(),
            society_name: $("#addressForm input[name='society_name']").val(),
            locality: $("#addressForm input[name='locality']").val(),
            landmark: $("#addressForm input[name='landmark']").val(),
            pincode: $("#addressForm input[name='pincode']").val(),
            city: $("#addressForm input[name='city']").val(),
            state: $("#addressForm input[name='state']").val(),
            delivery: $("#addressForm input[name='delivery']").val(),
            uuid: $("#addressForm input[name='uuid']").val(),
            mobile:$("#addressForm input[name='mobile']").val(),
            name:$("#addressForm input[name='name']").val(),
        };
        $('.errormsg').text('');
        $.ajax({
            url: "{{route('customers.profile.address.update')}}", // Update with your endpoint
            type: 'GET',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('.errormsg').text(''); 
                    $('#addressForm')[0].reset();
                    // toastr.success(response.message);
                    location.reload();
                    hideAddressPop();
                   
                } else {
                    // Show error messages
                    if (response.status == 401) {
                        // toastr.error(response.message);
                         document.getElementById('logoutPopup3').style.display='flex';
                    } else {
                        $.each(response.errors, function(key, value) {
                            $("#addressForm input[name='" + key + "']").next('.errormsg').text(value).show();
                        });
                    }
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Unprocessable Entity
                var errors = xhr.responseJSON.errors;
                $('.errormsg').text(''); 
                $.each(errors, function(key, value) {
                    var errorMessage = Array.isArray(value) ? value[0] : value;
                    $('.' + key + 'Error').text(errorMessage);
                });
            } else {
                $('.errormsg').text('');
                 document.getElementById('logoutPopup3').style.display='flex';
                // toastr.error('An error occurred. Please try again.');
            }
            }
        });
}
function hideAddressPop() {
    $('.addressFormPop1').hide();
    location.reload();
    // $('#addressForm')[0].reset(); // Reset the form fields  
    // $('.errormsg').text(''); // Clear error messages
    // $('#DA').prop('checked', false); // Uncheck the checkbox
}
  </script>
    