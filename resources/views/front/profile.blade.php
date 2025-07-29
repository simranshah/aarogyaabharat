@extends('front.layouts2.layout2')
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
                            <div class="profileAccorClick" onclick="changeStatusTab('2');">
                                <img src="{{asset('front/images/order_info.svg')}}" alt="order_info" class="icon1" />
                                <p>Order Info</p>
                                <img src="{{asset('front/images/rightArrow.svg')}}" alt="rightArrow" class="arrow1" />
                            </div>
                            <div class="profileAccorAns" >
                                <div class="orderinfo_title">
                                    <h2>Order Info</h2>
                                </div>
                                <div class="filter">
                                    <div class="filtertitle"><p>Filter</p><img src="{{asset('front/images/Filter.svg')}}" alt="Filter" /></div>
                                    <ul>
                                        @foreach($statuses as $status)
                                        @if($status->name=='Order Placed' ||$status->name=='Delivered' || $status->name=='Order Cancelled' ||  $status->name=='Return picked up' )
                                            <li>
                                                <a  onClick="changeStatusTab('{{ $status->id }}')">
                                                    @if($status->name !='Return picked up' && $status->name!='Delivered')
                                                    <span>{{ $status->name }}</span>
                                                    @elseif($status->name=='Delivered')
                                                   <span>Order Delivered</span>
                                                 @else
                                                 <span>Order Return</span>
                                                 @endif
                                                    <img src="{{ asset('front/images/Vector_plus.svg') }}" alt="Vector_plus" />
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div id="orders">
                                    {{-- @include('front.common.customer-orders') --}}
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
                        {{-- <div>
                            <div class="needaneme">
                                <h2>Need an emergency help</h2>
                                <a href="tel:{{ env('HELP_LINE_NO') }}" class="phone_eme"><img src="{{asset('front/images/phone_call.svg')}}" alt="phone_call"><p>{{ env('HELP_LINE_NO') }}</p><span>Call Now</span></a>
                                <a href="mailto:{{ env('HELP_LINE_EMAIL') }}" class="mail_eme"><img src="{{asset('front/images/mail.svg')}}" alt="mail"><p>{{ env('HELP_LINE_EMAIL') }}</p></a>
                            </div>
                        </div> --}}
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

<div class="areyousurePop winScrollStop" id='areyousurePop'>
    <div class="areyousureBlock">
        <a href="#;"><img src="{{asset('front/images/cross.svg')}}" alt="cross" /></a>
        <strong>Do you really want to cancel this order?</strong>
        <label for="qtyInput" style="display:block; margin: 12px 0 4px 86px; font-weight: 600; color: #333;">Select quantity to cancel</label>
        <div  style="margin-left:118px; margin-bottom: 12px; align-items: center; gap: 10px;">
            <a href="#;" id="decreaseQty" style="padding: 0 10px;border-radius: 8px;
    border: 2px solid #FFCC5C;
    text-align: center;
    font-size: 16px;
    font-family: 'Nunito-Bold';
    color: #F2A602;
    ">-</a>
            <input type="number" id="qtyInput" value="1" min="1" style="width: 50px; text-align: center;border: 2px solid #FFCC5C;
    text-align: center;
    font-size: 16px;
    font-family: 'Nunito-Bold';
    " />
            <a href="#;" id="increaseQty" style="padding: 0 10px;border-radius: 8px;
    border: 2px solid #FFCC5C;
    text-align: center;
    font-size: 16px;
    font-family: 'Nunito-Bold';
    color: #F2A602;
    ">+</a>
        </div>
            <div class="btnpop" style="display: flex; align-items: center; gap: 10px;">
            <a href="#;" id='cancelorder'>Yes</a>
            <a href="#;">No</a>
        </div>
        <script>
            $(document).on('click', '#increaseQty', function(e) {
            e.preventDefault();
            let $input = $('#qtyInput');
            let val = parseInt($input.val()) || 1;
            let max = parseInt($input.attr('max')) || Infinity;
            if(val < max) $input.val(val + 1);
            // $input.val(val + 1);
            });
            $(document).on('click', '#decreaseQty', function(e) {
            e.preventDefault();
            let $input = $('#qtyInput');
            let val = parseInt($input.val()) || 1;
            if(val > 1) $input.val(val - 1);
            });
        </script>
    </div>
</div>

<div id="address">
        @include('front.common.update-customer-address')
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
 <div class="log-out">
<div class="popup-overlay" id="logoutPopup2" style="display: none;">
    <div class="popup">
      <button class="close-btn" onclick="closePopupadressadd()">&times;</button>
      <img src="{{asset('front/images/add_adress_success.svg')}}" alt="Logout" class="popup-image1" />
      {{-- <h2 class="popup-title">Come back soon!</h2> --}}
      <p class="popup-text">Address was successfully saved.</p>
      <div class="popup-buttons">
        <button class="btn cancel-btn" onclick="closePopupadressadd()">OK</button>
      </div>
    </div>
  </div>
 </div>
 <div class="log-out">
<div class="popup-overlay" id="logoutPopup6" style="display: none;">
    <div class="popup" style="max-width: 353px;">
     <button class="close-btn" onclick="document.getElementById('logoutPopup6').style.display='none';" >&times;</button>
      {{-- <img src="{{asset('front/images/add_adress_success.svg')}}" alt="Logout" class="popup-image1" /> --}}
      {{-- <h2 class="popup-title">Come back soon!</h2> --}}
      <p class="popup-text">That hurts a little, talk to us before you go?</p>
      <div class="popup-buttons">
    <a href="{{route('raise.query')}}"><button class="btn yes-btn" style="padding: 10px 1px;" >Raise Query</button></a>
       <button class="btn cancel-btn" style="padding: 10px 1px;" onclick="cancelItems();">Cancel Items</button>
      </div>
    </div>
  </div>
 </div>
 <div class="order-info-pop-upmodal-overlay" id="modalOverlay" onclick="closeModalOnOverlay(event)">

    </div>
 <div class="add-adress-popup-overlay" id="add-adress-popup-overlay">
        <div class="add-adress-popup-container">
            <button class="add-adress-close-btn" onclick="closePopup5()">&times;</button>

            <div class="add-adress-popup-header">
                <h2 class="add-adress-popup-title" id="add-adress-popup-title">Edit Address</h2>
                <p class="add-adress-popup-subtitle">Enter pincode to get accurate delivery info</p>
            </div>

            <form id="addressForm5" onsubmit=" updateAddress(event)">
                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="fullName">Full Name<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="fullName" name="name" placeholder="Enter Your Full Name" value="" required>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="mobile">Mobile Number<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="tel" id="mobile" name="mobile" placeholder="Enter Mobile Number" required>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="pincode">Pincode<span class="add-adress-required">*</span></label>
                        <input type="text" id="pincode" name="pincode"  onblur="chekPincodeAvil(this.value);" placeholder="Enter 6-digit pincode" maxlength="6" required>
                        <div id="error-message_pin"></div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="pincode">House Number<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="house_number" name="house_number" placeholder="Flat, House no, Building, Apartment">
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="pincode">Society Name<span class="add-adress-required">*</span></label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="society_name" name="society_name" placeholder="Area, Street, Sector, Village, Town">
                            <div class="errormsg"></div>
                        </div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="landmark">Landmark (optional)</label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="landmark" name="landmark" placeholder="Enter nearby landmark">
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-form-row">
                    <div class="add-adress-form-group">
                        <label for="city">City</label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="city" name="city" placeholder="Enter Your City" readonly>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                    <div class="add-adress-form-group">
                        <label for="state">State</label>
                        <div class="add-adress-input-wrapper valid">
                            <input type="text" id="state" name="state" placeholder="Enter Your State" readonly>
                            <div class="errormsg"></div>
                        </div>
                    </div>
                </div>

                <div class="add-adress-checkbox-container">
                    <div class="add-adress-checkbox-group">
                        <input type="checkbox" id="defaultAddress" name="delivery">
                        <label for="defaultAddress">Mark as Default Address</label>
                    </div>
                </div>

                <button type="submit" class="add-adress-submit-btn">Submit</button>
            </form>
        </div>
    </div>
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/slick.js') }}"></script>
<script src="{{ asset('front/js/script.js') }}"></script>
<script>
        function closePopup5() {
            document.querySelector('.add-adress-popup-overlay').style.display = 'none';
        }

        // Form validation
        const form = document.getElementById('addressForm');
        const inputs = form.querySelectorAll('input[type="text"], input[type="tel"]');

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validateField(this);
            });

            input.addEventListener('blur', function() {
                validateField(this);
            });
        });

        function validateField(field) {
            const wrapper = field.closest('.input-wrapper');
            if (!wrapper) return;

            const isValid = field.value.trim() !== '';

            if (field.type === 'tel') {
                const phoneRegex = /^[6-9]\d{9}$/;
                if (isValid && !phoneRegex.test(field.value)) {
                    wrapper.classList.remove('valid');
                    return;
                }
            }

            if (field.name === 'pincode') {
                const pincodeRegex = /^\d{6}$/;
                if (isValid && !pincodeRegex.test(field.value)) {
                    wrapper.classList.remove('valid');
                    return;
                }
            }

            // if (isValid) {
            //     wrapper.classList.add('valid');
            // } else {
            //     wrapper.classList.remove('valid');
            // }
        }

        // Pincode auto-fill city and state
        document.getElementById('pincode').addEventListener('input', function() {
            const pincode = this.value;
            if (pincode.length === 6) {
                // This is a mock implementation - in real apps, you'd call an API
                setTimeout(() => {
                    validateField(document.getElementById('city'));
                    validateField(document.getElementById('state'));
                }, 500);
            }
        });
        // Close popup when clicking outside
        document.querySelector('.add-adress-popup-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup5();
            }
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup5();
            }
        });
    </script>
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
                // toastr.success('Profile updated successfully!');
                window.location.reload;
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
            // toastr.success('Profile updated successfully!');
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
                 document.getElementById('logoutPopup3').style.display='flex';
                // toastr.error('Something went wrong please try again!');
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
            // toastr.success('Address added successfully!');
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
                 document.getElementById('logoutPopup3').style.display='flex';
                // toastr.error('Something went wrong please try again');
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
                 document.getElementById('logoutPopup3').style.display='flex';
                // toastr.error('Something went wrong please try again');
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
                    // toastr.success(response.message);
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
    });
}


function editAddress(id) {
    $('.errormsg').text('');
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
                 window.location.reload;
                 document.getElementById('logoutPopup2').style.display='flex';
                // $('.errormsg').text('');
                $('#addressList').html(response.html);

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
$('.errormsg').css('color', 'red');
function addNewAddress() {
    $('.errormsg').text('');
    $('#addressForm5')[0].reset();
    document.getElementById('add-adress-popup-title').innerHTML="Add Address";
     document.getElementById('add-adress-popup-overlay').style.display='flex';
}
let showpoupFlage = localStorage.getItem('address_required');
if (showpoupFlage == '1') {
     $('#addressForm5')[0].reset();
     document.getElementById('add-adress-popup-title').innerHTML="Add Address";
     document.getElementById('add-adress-popup-overlay').style.display='flex';
    // Optionally clear the flag so it doesn't show again
    document.getElementById('text-btween-cartpopup').innerHTML='Let’s add your address first.'
                            cartPopup();
    localStorage.removeItem('address_required');
}
function hideAddressPop(){
    $('#addressForm5')[0].reset();
    $('.add-adress-popup-overlay').hide();
}
function confirmLogoutpopup() {
    $('#logoutPopup').show();
}
function closePopupadressadd(){
    document.getElementById('logoutPopup2').style.display='none';
}
function chekPincodeAvil(pincode) {
                document.getElementById('error-message_pin').innerHTML = 'Searching...';
                document.getElementById('error-message_pin').style.color = 'black';
                $.ajax({
                    url: "{{ url('/get-city-state') }}/" + pincode, // Change this to your actual endpoint
                    method: 'GET', // Use POST or GET as needed

                    success: function(response) {
                        if (response.success) {
                            document.getElementById('error-message_pin').innerHTML = '';
                            document.getElementById('state').value = response.state;
                            document.getElementById('city').value = response.city;
                        } else {
                            document.getElementById('state').value = '';
                            document.getElementById('city').value = '';
                            document.getElementById('error-message_pin').innerHTML = response.message;
                             document.getElementById('error-message_pin').style.color = 'red';
                        }
                    }
                });
            }
</script>
<script>
    let selectedItems = [];

    function openModal() {
        const modal = document.getElementById('modalOverlay');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('modalOverlay');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function closeModalOnOverlay(event) {
        if (event.target === event.currentTarget) {
            closeModal();
        }
    }

    function toggleItem(card, index) {
        const checkbox = document.getElementById(`checkbox-${index}`);

        if (selectedItems.includes(index)) {
            selectedItems = selectedItems.filter(i => i !== index);
            checkbox.classList.remove('checked');
            card.classList.remove('selected');
        } else {
            selectedItems.push(index);
            checkbox.classList.add('checked');
            card.classList.add('selected');
        }

        updateCancelButton();
    }

   function changeQuantity(event, index, change) {
    event.stopPropagation();
    const qtyElement = document.getElementById(`qty-${index}`);
    const card = qtyElement.closest('.order-info-pop-upitem-card');
    const maxQty = parseInt(card.getAttribute('data-max-qty'));

    let currentQty = parseInt(qtyElement.textContent);
    let newQty = currentQty + change;

    // Prevent quantity from going below 1 or above max
    if (newQty < 1 || newQty > maxQty) {
        if (newQty > maxQty) {
            alert("You cannot cancel more than originally ordered quantity.");
        }
        return;
    }

    qtyElement.textContent = newQty;

    // Update QTY display
    // const qtyDisplay = card.querySelector('.order-info-pop-upproduct-qty');
    // qtyDisplay.textContent = `QTY : ${newQty}`;
}


    function updateCancelButton() {
        const cancelBtn = document.querySelector('.cancel-button');
        if (selectedItems.length > 0) {
            cancelBtn.disabled = false;
        } else {
            cancelBtn.disabled = true;
        }
    }

    function cancelItems() {
        const reason = document.getElementById('cancel-reason')?.value;
        if (!reason) {
           document.getElementById('select-error-msg').innerHTML='Please select a cancellation reason.';
            document.getElementById('logoutPopup6').style.display = 'none';
            return;
        }

        let ajaxCalls = selectedItems.length;
        let completedCalls = 0;

        selectedItems.forEach(index => {
            const card = document.querySelector(`.order-info-pop-upitem-card[data-index="${index}"]`);
            const productId = card.getAttribute('data-product-id');
            const qty = document.getElementById(`qty-${index}`).innerText;

            $.ajax({
                url: '/customer/remove-order-item/' + productId,
                type: 'GET',
                data: {
                    qtyToRemove: qty,
                    reason: reason
                },
                success: function(response) {
                    completedCalls++;
                    if (response.success) {
                        // Example: You can show a message or reload
                        console.log('Cancelled:', response.message);
                    } else {
                        document.getElementById('logoutPopup3').style.display = 'flex';
                    }
                    if (completedCalls === ajaxCalls) {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    completedCalls++;
                    document.getElementById('logoutPopup3').style.display = 'flex';
                    if (completedCalls === ajaxCalls) {
                        location.reload();
                    }
                }
            });
        });
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });

    updateCancelButton();
    function openpoupcancelpopup() {
                // Logic to handle the cancel action
                // const selectedItems = [];
                const cancelReason = document.getElementById('cancel-reason').value;

                if (!cancelReason) {
                    document.getElementById('select-error-msg').textContent = 'Please select a cancellation reason.';
                    return;
                } else {
                    document.getElementById('select-error-msg').textContent = '';
                }

                // Proceed with the cancellation logic (e.g., AJAX request)
        if (selectedItems.length === 0) {
            document.getElementById('selctproductid').textContent = 'Please select at least one item to cancel.';
        //    alert('Please select at least one item to cancel.');
            return;
        }else{
              document.getElementById('selctproductid').textContent = '';
        }

               document.getElementById('logoutPopup6').style.display='flex';

            }
</script>

@endsection('content')
