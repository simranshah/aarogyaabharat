
@if(isset($offerAndDiscounts))
@foreach($offerAndDiscounts as $offer)
<div class="offer_slider_padd">
                <div class="offer_slider_block">
                    <img src="{{ Storage::url($offer->image) }}" alt="" >
                    <div class="offer_con">
                        <h5>{{$offer->title}}</h5>
                        <p>{{$offer->description}}</p>
                    </div>
                    <div class="offer_det">
                        <i>*T&C apply</i>
                        <a href="javascript:void(0);" class="copy-code" data-code="{{ $offer->code }}">Copy code</a>
                    </div>
                </div>
            </div>
@endforeach
@endif            