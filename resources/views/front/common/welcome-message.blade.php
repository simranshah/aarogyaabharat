
@if(Auth::check() && Auth::user()->hasRole('Customer'))
    <div class="welcomelabel" style="display: block;">
        <div class="container">
            <a href="#;"><img src="{{ asset('front/images/cross.svg') }}" alt="" /> </a>
            <div>
                <img src="{{ asset('front/images/welcom_pop.svg') }}" alt="" />
                <div>
                    <strong>Welcome to Aarogya Bharat </strong>
                    <p>We have 5 top products based on your search</p>
                </div>
            </div>
        </div>
    </div>
@endif
