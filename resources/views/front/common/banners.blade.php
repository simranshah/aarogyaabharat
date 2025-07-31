@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp

            @if($isMobile)
                @foreach($mobileBannerImages as $banner)
                <div class="bannerBlock">
                    <a href="{{ $banner->link }}" target="_blank">
                      <img width="100%" class="bannerImage" src="{{ asset('storage/' . $banner->image) }}"
                                        alt="Mobile Banner" loading="lazy">
                      </a>
                    </div>
                @endforeach
            @else
                @foreach($bannerImages as $banner)
                <div class="bannerBlock">
                    <a href="{{ $banner->link }}" target="_blank">
                      <img width="100%" class="bannerImage" src="{{ asset('storage/' . $banner->image) }}"
                                        alt="Desktop Banner" loading="lazy">
                      </a>
                    </div>
                @endforeach
            @endif
        