
<div class="addressFormPop winScrollStop">
<div class="addressFormPopMiddle">
        <div class="addressFormPopInner">
            <a href="#;" onClick="hideAddressPop()"><img src="{{asset('front/images/cross.svg')}}" alt="cross" /> </a>
            <h4> Edit Address</h4>
            <p>Please enter pin code to get current location.</p>
            <form id="addressForm"> 
                <div class="inputMainBlock fullwidth">
                    <span>Change Name</span>
                    <input type="text" name="name" class="AnyValueVD" placeholder="Name" value="{{Auth::user()->name}}">
                    <div class="errormsg">Please enter Flat,House no, Building, Company, Apertment</div>
                </div>
                <div class="inputMainBlock fullwidth">
                    <span>Change Mobile</span>
                    <input type="text" name="mobile" class="AnyValueVD" placeholder="9999999999" value="{{Auth::user()->mobile}}">
                    <div class="errormsg">Please enter Flat,House no, Building, Company, Apertment</div>
                </div>
            <input type="hidden" name="uuid" id="uuid" value="">
            <!-- House Number -->
            <div class="inputMainBlock fullwidth">
                <span>Flat / House No.</span>
                <input type="text" class="AnyValueVD" placeholder="Flat / House No." name="house_number" value="">
                <div class="errormsg house_numberError">Please enter House Number</div>
            </div>

            <!-- Society Name -->
            <div class="inputMainBlock fullwidth">
                <span>Society / House / Building Name</span>
                <input type="text" class="AnyValueVD" placeholder="Society / House / Building Name" name="society_name" value="">
                <div class="errormsg societyError">Please enter Society Name</div>
            </div>

            <!-- Locality -->
            {{-- <div class="inputMainBlock fullwidth">
                <span>Locality</span>
                <input type="text" class="AnyValueVD" placeholder="XYZ" name="locality" value="">
                <div class="errormsg localityError">Please enter Locality</div>
            </div> --}}

            <!-- Landmark -->
            <div class="inputMainBlock fullwidth">
                <span>Landmark (Optional)</span>
                <input type="text" class="AnyValueVD" placeholder="Landmark (Optional)" name="landmark" value="">
                <div class="errormsg landmarkError">Please enter Landmark</div>
            </div>

            <!-- Pincode -->
            <div class="inputMainBlock fullwidth">
                <span>Pincode</span>
                <input type="text" class="AnyValueVD" placeholder="000000" name="pincode" value="">
                <div class="errormsg pincodeError">Please enter Pincode</div>
            </div>

            <!-- City -->
            <div class="inputMainBlock fullwidth">
                <span>City/ Town</span>
                <input type="text" class="AnyValueVD" placeholder="City / Town" name="city" value="">
                <div class="errormsg cityError">Please enter City</div>
            </div>

            <!-- State -->
            <div class="inputMainBlock fullwidth">
                <span>State</span>
                <input type="text" name="state" class="AnyValueVD" placeholder="XYZ" value="">
                <div class="errormsg">Please enter State</div>
            </div>

            <!-- Set as Delivery -->
            <div class="inline-checkbox-block fullwidth">
                <label for="DA" class="checkbox-label">
                    <input type="checkbox" id="DA" name="delivery">
                   <span> Set as delivery</span>
                </label>
            </div>
                <div class="checkboxPart fullwidth"> 
                    <button class="submitBTN" type="submit" onClick="updateAddress(event)">Save Address</button>
                </div>
            </form>
        </div>
    </div>
</div>
 


