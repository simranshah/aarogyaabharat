@extends('front.layouts.layout')
@section('content')

<div class="searchPop winScrollStop">
    <div class="searchPopBlock">
        <strong>Recent Search</strong>
        <p>Our highest rented or buying products.</p>
        <ul>
            <li>
                <a href="#;">
                    <img src="{{ asset('front/images/search_fil.svg')}}" alt="search_fil" />
                    <p>Long product name</p>
                    <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /> 
                </a>
            </li>
            <li>
                <a href="#;">
                    <img src="{{ asset('front/images/search_fil.svg')}}" alt="search_fil" />
                    <p>Product name</p>
                    <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /> 
                </a>
            </li>
            <li>
                <a href="#;">
                    <img src="{{ asset('front/images/search_fil.svg')}}" alt="search_fil" />
                    <p>Product</p>
                    <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /> 
                </a>
            </li>
            <li>
                <a href="#;">
                    <img src="{{ asset('front/images/search_fil.svg')}}" alt="search_fil" />
                    <p>Small product name</p>
                    <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /> 
                </a>
            </li>
        </ul>
        
        <div class="popPro">
        <strong>Popular Products</strong>
        <a href="#;">Long product name <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /></a>
        <a href="#;">product name <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /></a>
        <a href="#;">product <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /></a>
        <a href="#;">Small product name <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /></a>
        <a href="#;">Name of product <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /></a>
        <a href="#;">Popular product name  <img src="{{ asset('front/images/curly_arrow.svg')}}" alt="curly_arrow" /></a>
        </div>
    </div>
</div>

<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="#;">Home</a> </li>
            <li><a href="#;">Profile</a> </li>
        </ul>
    </div>    
</div>
    
<section class="profilePart">
    <div class="container">
        <div class="row18">
            <div class="profilePaddL">
                <div class="profileBlock">
                    <div class="profileTag_name">
                    @php
                        $nameParts = explode(' ', $customerDetail->name);
                        $initials = array_map(function($part) {
                            return strtoupper($part[0]); 
                        }, $nameParts);
                        $formattedName = implode('', $initials);
                    @endphp

                        <div class="profileTag">{{ $formattedName }}</div>
                        <div id="profileDetails">
                            @include('front.common.profile-detail')
                        </div>
                    </div>
                    <div class="helpBlock">
                        <p>Need an emergency help</p>
                        <a href="https://wa.me/{{ env('HELP_LINE_NO') }}"><img src="{{asset('front/images/help_whata-app.svg')}}" alt="help_whata-app" /> </a>
                        <a href="tel:{{ env('HELP_LINE_NO') }}"><img src="{{asset('front/images/help_call.svg')}}" alt="help_call" /> </a>
                        <a href="mailto:{{ env('HELP_LINE_EMAIL') }}"><img src="{{asset('front/images/help_mail.svg')}}" alt="help_mail" /> </a>
                    </div>
                </div>
            </div>
            <div class="profilePaddR">
                <div class="profileBlock">
                    <div class="profileAccor">
                        <div>
                            <div class="profileAccorClick">
                                <img src="{{asset('front/images/my_addresses.svg')}}" alt="my_addresses" class="icon1" />
                                <p>My Addresses</p>
                                <img src="{{asset('front/images/rightArrow.svg')}}" alt="rightArrow" class="arrow1" />
                            </div>
                            <div class="profileAccorAns" id="customerAdress">
                                <div class="profileAccorAnsTtl">
                                    <strong>My Addresses</strong>
                                    <a href="javascript:void(0)" onclick="addNewAddress()" >Add New Address <img src="{{asset('front/images/jam_plus.svg')}}" alt="jam_plus" /> </a>
                                </div>
                                <div id="addressList">
                                    @include('front.common.customer-address')
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="profileAccorClick">
                                <img src="{{asset('front/images/order_info.svg')}}" alt="order_info" class="icon1" />
                                <p>Order Info</p>
                                <img src="{{asset('front/images/rightArrow.svg')}}" alt="rightArrow" class="arrow1" />
                            </div>
                            <div class="profileAccorAns">
                                <div class="orderinfo_title">
                                    <h2>Order Info</h2>
                                </div>
                                <div class="filter">
                                    <div class="filtertitle"><p>Filter</p><img src="{{asset('front/images/Filter.svg')}}" alt="Filter" /></div>
                                    <ul>
                                        @foreach($statuses as $status)
                                            <li>
                                                <a  onClick="changeStatusTab('{{ $status->id }}')">
                                                    <span>{{ $status->name }}</span>
                                                    <img src="{{ asset('front/images/Vector_plus.svg') }}" alt="Vector_plus" />
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div id="orders">
                                    @include('front.common.customer-orders')
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{route('terms.and.conditions')}}" class="profileAccorClick">
                                <img src="{{asset('front/images/terms_condition.svg')}}" alt="terms_condition" class="icon1" />
                                <p>Terms & Condition</p> 
                            </a>
                        </div>
                        <div>
                        <a  class="profileAccorClick" onclick="confirmLogoutpopup();">
                                <img src="{{ asset('front/images/logout.svg') }}" alt="logout" class="icon1" />
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        <div>
                            <div class="needaneme">
                                <h2>Need an emergency help</h2>
                                <a href="tel:{{ env('HELP_LINE_NO') }}" class="phone_eme"><img src="{{asset('front/images/phone_call.svg')}}" alt="phone_call"><p>{{ env('HELP_LINE_NO') }}</p><span>Call Now</span></a>
                                <a href="mailto:{{ env('HELP_LINE_EMAIL') }}" class="mail_eme"><img src="{{asset('front/images/mail.svg')}}" alt="mail"><p>{{ env('HELP_LINE_EMAIL') }}</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>
<div class="locationPop winScrollStop">
    <div class="locationBlock">
        <a href="#;"><img src="{{asset('front/images/cross.svg')}}" alt="cross" /></a>
        <h4>Select Delivery Location</h4>
        <p>Please enter pin code to get current location.</p>
        <div class="inputPart">
            <input type="text" placeholder="Enter pin code" />
            <a href="#;">Check</a>
        </div>
        <div class="currLoc">
            <img src="{{asset('front/images/pin.svg')}}" alt="pin" />
            <a href="#;">Select Current Location</a>
        </div>
        <button>Get Location</button>
    </div>
</div>
 
<div class="areyousurePop winScrollStop">
    <div class="areyousureBlock">
        <a href="#;"><img src="{{asset('front/images/cross.svg')}}" alt="cross" /></a>
        <strong>Are you sure want to cancel order?</strong>
        <div class="btnpop">
            <a href="#;">Yes</a>
            <a href="#;">No</a>
        </div>
    </div>
</div>

<div id="address">
        @include('front.common.update-customer-address')
</div>                    
</div>
<!-- <div class="addressFormPop winScrollStop">
    <div class="addressFormPopMiddle">
        <div class="addressFormPopInner">
            <a href="#;"><img src="{{asset('front/images/cross.svg')}}" alt="" /> </a>
            <h4>Add New Address</h4>
            <p>Please enter pin code to get current location.</p>
            <form id="addressForm"> 
                <div class="inputMainBlock fullwidth">
                    <span>House Number</span>
                    <input type="text" class="AnyValueVD" placeholder="004" name="house_number"> 
                    <div class="errormsg house_numberError">Please enter House Number</div>
                </div> 
                <div class="inputMainBlock fullwidth">
                    <span>Society Name</span>
                    <input type="text" class="AnyValueVD" placeholder="XYZ" name="society"> 
                    <div class="errormsg societyError">Please enter Society Name</div>
                </div> 
                <div class="inputMainBlock fullwidth">
                    <span>Locality</span>
                    <input type="text" class="AnyValueVD" placeholder="XYZ" name="locality"> 
                    <div class="errormsg localityError">Please enter Locality</div>
                </div> 
                <div class="inputMainBlock fullwidth">
                    <span>Landmark</span>
                    <input type="text" class="AnyValueVD" placeholder="XYZ" name="landmark"> 
                    <div class="errormsg landmarkError">Please enter Landmark</div>
                </div> 
                <div class="inputMainBlock fullwidth">
                    <span>Pincode</span>
                    <input type="text" class="AnyValueVD" placeholder="000000" name="pincode"> 
                    <div class="errormsg pincodeError">Please enter Pincode</div>
                </div>
                <div class="inputMainBlock fullwidth">
                    <span>City</span>
                    <input type="text" class="AnyValueVD" placeholder="XYZ" name="city"> 
                    <div class="errormsg cityError">Please enter City</div>
                </div>
                <div class="checkboxPart fullwidth"> 
                    <button class="submitBTN" type="submit" onClick="addAddress(event)">Save Address</button>
                </div>
            </form>
        </div>
    </div>
</div> -->


<div class="updateprofilePop winScrollStop">
    <div class="updateprofilePopMiddle">
        <div class="updateprofilePopInner">
            <a href="#;"><img src="{{asset('front/images/cross.svg')}}" alt="cross"> </a>
            <h4>Update Profile</h4>
            <p>You can update you profile details here</p>
            <form id="updatepro">
                <div class="inputMainBlock fullwidth">
                    <span>Full Name<i>*</i></span>
                    <input type="text" class="FullNameVD" name="full_name"  value="{{$customerDetail->name}}" placeholder="Full Name"> 
                    <div class="perrormsg full_nameError"></div> <!-- Error message container -->
                </div>
                <div class="inputMainBlock fullwidth">
                    <span>E-mail ID<i>*</i></span>
                    <input type="text" class="emailVD" name="email" placeholder="example@gmail.com" value="{{$customerDetail->email}}"> 
                    <div class="perrormsg emailError"></div> <!-- Error message container -->
                </div>
                <div class="inputMainBlock fullwidth">
                    <span>Mobile Number<i>*</i></span>
                    <input type="text" class="mobileVD" name="mobile" placeholder="00000 00000" value="{{$customerDetail->mobile}}"> 
                    <div class="perrormsg mobileError"></div> <!-- Error message container -->
                </div>
                <div class="inputMainBlock fullwidth">
                    <span>City<i>*</i></span>
                    <input type="text" class="AnyValueVD" id="ccity" name="city" placeholder="City" value="{{$customerDetail->city}}"> 
                    <div class="perrormsg cityError"></div> <!-- Error message container -->
                </div>
                <div class="checkboxPart fullwidth"> 
                    <button type="submit" class="submitBTN" onClick="updateProfile()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <div class="log-out">
  <!-- Popup Structure -->
  <div class="popup-overlay" id="logoutPopup" style="display: none;">
    <div class="popup">
      <button class="close-btn" onclick="closePopup()">&times;</button>
      <img src="{{asset('front/images/grandpa.svg')}}" alt="Logout" class="popup-image" />
      <h2 class="popup-title">Come back soon!</h2>
      <p class="popup-text">Are you sure you want to logout?</p>
      <div class="popup-buttons">
        <button class="btn yes-btn" onclick="confirmLogout()">Yes</button>
        <button class="btn cancel-btn" onclick="closePopup()">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="log-out">
<div class="popup-overlay" id="logoutPopup1" style="display: none;">
    <div class="popup">
      <button class="close-btn" onclick="closePopupadress()">&times;</button>
      <img src="{{asset('front/images/grandpa_delete.svg')}}" alt="Logout" class="popup-image1" />
      {{-- <h2 class="popup-title">Come back soon!</h2> --}}
      <p class="popup-text">Are you sure you want to Delete?</p>
      <div class="popup-buttons">
        <button class="btn yes-btn" id="delete_Adress">Yes</button>
        <button class="btn cancel-btn" onclick="closePopupadress()">Cancel</button>
      </div>
    </div>
  </div>
 </div>    
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/slick.js') }}"></script>
<script src="{{ asset('front/js/script.js') }}"></script>
<script>
     function closePopup() {
    document.getElementById("logoutPopup").style.display = "none";
  }
$(document).ready(function() {
    $('#updatepro').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Clear previous error messages
        $('.errormsg').text('');

        // Gather form data using the FormData object
        var formData = $(this).serialize(); // Serialize form data
        var _token = '{{@csrf_token()}}'; // Serialize form data

        // Perform the AJAX request
        $.ajax({
            type: 'POST',
            url: '{{ route("customers.profile.update") }}', // Use Laravel route helper
            data: formData,
            success: function(response) {
                // Handle success
                toastr.success('Profile updated successfully!');
                $('#updatepro')[0].reset(); // Optionally reset the form
            },
            error: function(xhr) {
                // Clear previous error messages
                $('.errormsg').text('');
                
                // Handle error - display validation errors
                var errors = xhr.responseJSON.errors;
                
                // Loop through the errors and show them under the respective fields
                for (var field in errors) {
                    $('.' + field + 'Error').text(errors[field][0]);
                }
            }
        });
    });
});

function updateProfile() {
    
    // Gather form data
    var formData = {
        _token: "{{ csrf_token() }}", // Include CSRF token directly
        full_name: $('input[name="full_name"]').val(),
        email: $('input[name="email"]').val(),
        mobile: $('input[name="mobile"]').val(),
        city: $("#ccity").val(),
    };

    // Clear previous error messages and hide them
    $('.perrormsg').text('').hide();

    $.ajax({
        url: "{{ route('customers.profile.update') }}", // Your endpoint
        type: 'POST', // Use POST for update
        data: formData,
        success: function(response) {
            // Handle success
            $('.perrormsg').text('').hide();
            $('#profileDetails').html(response.html);
            $('.updateprofilePop').hide();
            toastr.success('Profile updated successfully!');
            window.location.reload();
        },
        error: function(xhr) {
            if (xhr.status === 422) { // Unprocessable Entity
                var errors = xhr.responseJSON.errors;

                // Display error messages
                $.each(errors, function(key, value) {
                    var errorMessage = Array.isArray(value) ? value[0] : value;
                    var errorElement = $('.' + key + 'Error');                   
                    errorElement.text(errorMessage).show(); // Set text and show error
                });
            } else {
                toastr.error('Something went wrong please try again!');
            }
        }
    });
}



    function addAddress(event) {
    // event.preventDefault(); // Prevent the default form submission

    // Gather form data
    var formData = {
        house_number: $('input[name="house_number"]').val(),
        society: $('input[name="society"]').val(),
        locality: $('input[name="locality"]').val(),
        landmark: $('input[name="landmark"]').val(),
        pincode: $('input[name="pincode"]').val(),
        city: $('input[name="city"]').val(),
        ṣtate: $('input[name="state"]').val(),
    };

    // Clear previous error messages
    $('.errormsg').text('');

    $.ajax({
        url: "{{ route('customers.address.add') }}", // Update with your endpoint
        type: 'GET', 
        data: formData,
        success: function(response) {
            $('.errormsg').text('');
            $('#addressList').html(response.html); // Assuming you have an element to update with the new address list
            toastr.success('Address added successfully!');
        },
        error: function(xhr) {
            if (xhr.status === 422) { // Unprocessable Entity
                var errors = xhr.responseJSON.errors;
                // Clear previous error messages
                $('.errormsg').text(''); 
                $.each(errors, function(key, value) {
                    // Check if value is an array or a single string
                    var errorMessage = Array.isArray(value) ? value[0] : value;
                    $('.' + key + 'Error').text(errorMessage); // Display the error message
                });
            } else {
                $('.errormsg').text('');
                toastr.error('Something went wrong please try again');
            }
        }
    });
}

function confirmLogout() {
   
       
            document.getElementById('logout-form').submit();
        

}

function changeStatusTab(statusId) {
        $.ajax({
            url: '{{ route('customer.orderStatusWise', ':id') }}'.replace(':id', statusId),
            method: 'GET',
            success: function(response) {
                $('#orders').html(response.customerDetailHtml);
            },
            error: function(xhr) {
                toastr.error('Something went wrong please try again');
            }
        });
}

function removeAddress(addressId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Remove!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/customer/remove-address/' + addressId,  
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#addressList').html(response.html);
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Something went wrong. Please try again.');
            }
        });
        }
    });       
}


function editAddress(id) {
    $.ajax({
        url: '/customer/get-update-address/' + id,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                $('#address').html(response.html);
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
                toastr.error('Error fetching address data.');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Something went wrong while fetching the address data.');
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
                    $('#addressList').html(response.html);
                    toastr.success(response.message);
                    hideAddressPop();
                } else {
                    // Show error messages
                    if (response.status == 401) {
                        toastr.error(response.message);
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
                toastr.error('An error occurred. Please try again.');
            }
            }
        });
}

function addNewAddress() {
    $('#addressForm')[0].reset();
    $('.addressFormPop').show();
}

function hideAddressPop(){
    $('#addressForm')[0].reset();
    $('.addressFormPop').hide();
}
function confirmLogoutpopup() {
    $('#logoutPopup').show();
}

</script>
@endsection('content')