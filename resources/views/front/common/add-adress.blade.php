<div class="addressFormPopMiddle">
            <div class="addressFormPopInner">
                <a href="#;"><img src="{{asset('front/images/cross.svg')}}" alt="" /> </a>
                <h4>Add New Address</h4>
                <p>Please enter pin code to get current location.</p>
                <form id="addressForm">
                    <div class="inputMainBlock fullwidth">
                        <span>Change Name</span>
                        <input type="text" name="name" class="AnyValueVD" placeholder="Name" value="@if(Auth::check()){{Auth::user()->name}}@endif">
                        <div class="errormsg">Please enter Flat,House no, Building, Company, Apertment</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Change Mobile</span>
                        <input type="text" name="mobile" class="AnyValueVD" placeholder="9999999999" value="@if( Auth::check()){{Auth::user()->mobile}} @endif">
                        <div class="errormsg">Please enter Flat,House no, Building, Company, Apertment</div>
                    </div>
                    {{-- <div class="inputMainBlock fullwidth">
                        <span>Flat,House no, Building, Company, Apertment  </span>
                        <input type="text" name="house_number" class="AnyValueVD" placeholder="004">
                        <div class="errormsg">Please enter Flat,House no, Building, Company, Apertment</div>
                    </div> --}}
                    <input type="hidden" name="uuid" class="AnyValueVD" placeholder="004">
                    <div class="inputMainBlock fullwidth">
                        <span>Flat / House No. </span>
                        <input type="text" name="house_number" class="AnyValueVD" placeholder="Flat /House No.">
                        <div class="errormsg">Please enter Flat,House no, Building, Company, Apertment</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Society / House / Building Name</span>
                        <input type="text" name="society_name" class="AnyValueVD" placeholder="XYZ">
                        <div class="errormsg">Please enter Area, Street, Sector, Village</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Landmark (Optional)</span>
                        <input type="text" name="landmark" class="AnyValueVD" placeholder="XYZ">
                        <div class="errormsg">Please enter Landmark</div>
                    </div>
                    <!-- <div class="inputMainBlock fullwidth">
                        <span>Locality</span>
                        <input type="text" name="locality" class="AnyValueVD" placeholder="XYZ">
                        <div class="errormsg">Please enter Locality</div>
                    </div> -->
                    <div class="inputMainBlock fullwidth">
                        <span>Pincode</span>
                        <input type="text" name="pincode" class="AnyValueVD" placeholder="000000">
                        <div class="errormsg">Please enter Pincode</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>Town/City</span>
                        <input type="text" name="city" class="AnyValueVD" placeholder="Town/City">
                        <div class="errormsg">Please enter Town/City</div>
                    </div>
                    <div class="inputMainBlock fullwidth">
                        <span>State</span>
                        <input type="text" name="state" class="AnyValueVD" placeholder="State">
                        <div class="errormsg">Please enter State</div>
                    </div>
                    <div class="inline-checkbox-block fullwidth">
                        <label for="DA" class="checkbox-label">
                            <input type="checkbox" id="DA" name="delivery">
                           <span> Set as delivery</span>
                        </label>
                    </div>
                    
                    <div class="checkboxPart fullwidth">
                        <button class="submitBTN">Save Address</button>
                    </div>
                </form>
            </div>
        </div>