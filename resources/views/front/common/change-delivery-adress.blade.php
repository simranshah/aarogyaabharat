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
                // Show the popup
                // $('.add-address-popup-overlay').style.display="flex";
                 document.getElementById('add-adress-popup-title').innerHTML="Edit Address";
                document.getElementById('add-adress-popup-overlay').style.display='flex';
                
                // Fill the form fields
                $('#fullName').val(response.address.name);
                $('#mobile').val(response.address.mobile);
                $('#pincode').val(response.address.pincode);
                $('#house_number').val(response.address.house_number);
                $('#society_name').val(response.address.society_name);
                $('#landmark').val(response.address.landmark);
                $('#city').val(response.address.city);
                $('#state').val(response.address.state);
                
                // Set default address checkbox if applicable
                if (response.address.is_delivery_address) {
                    $('#defaultAddress').prop('checked', true);
                } else {
                    $('#defaultAddress').prop('checked', false);
                }
                
                // Store the address ID in a hidden field (you might want to add this to your form)
                $('#addressForm5').append(`<input type="hidden" name="uuid" value="${id}">`);
                
                // Validate all fields that have values
                $('#add-address-form input').each(function() {
                    if ($(this).val().trim() !== '') {
                        validateField(this);
                    }
                });
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

    // Handle default address checkbox
    if (!$('#defaultAddress').prop('checked')) {
        $('#defaultAddress').val('0');
    } else {
        $('#defaultAddress').val('1');
    }

    // Collect form data
    var formData = $('#addressForm5').serialize();

    // Clear previous error messages
    $('.errormsg').text('');

    $.ajax({
        url: "{{ route('customers.profile.address.update') }}",
        type: 'GET',
        data: formData,
        success: function(response) {
            if (response.success) {
                  location.reload();
                //  document.getElementById('logoutPopup2').style.display='flex';
                // // $('.errormsg').text('');
                // $('#addressList').html(response.html);
               
                closePopup5(); // Use your popup closing function
            } else {
                if (response.status == 401) {
                    document.getElementById('logoutPopup3').style.display='flex';
                } else {
                    $.each(response.errors, function(key, value) {
                        // Find the appropriate field to display error
                        let errorElement;
                        switch(key) {
                            case 'name':
                                errorElement = $('#fullName').next('.errormsg');
                                break;
                            case 'mobile':
                                errorElement = $('#mobile').next('.errormsg');
                                break;
                            case 'house_number':
                                errorElement = $('#house_number').next('.errormsg');
                                break;
                            case 'society_name':
                                errorElement = $('#society_name').next('.errormsg');
                                break;
                            case 'pincode':
                                errorElement = $('#pincode').next('.errormsg');
                                break;
                            // Add other cases as needed
                            default:
                                errorElement = $(`[name="${key}"]`).next('.errormsg');
                        }
                        if (errorElement.length) {
                            errorElement.text(value).show();
                        }
                    });
                }
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                $('.errormsg').text('');
                $.each(errors, function(key, value) {
                    var errorMessage = Array.isArray(value) ? value[0] : value;
                    $(`.${key}Error`).text(errorMessage);
                });
            } else {
                $('.errormsg').text('');
                document.getElementById('logoutPopup3').style.display='flex';
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
    