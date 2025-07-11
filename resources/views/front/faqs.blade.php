
@extends('front.layouts.layout')
@section('content')
<div class="banneranimationbox">
    <div class="container mb-5">
         @if (isset($faqPageData) && isset($faqPageData->cms) && $faqPageData->cms->images && $faqPageData->cms->images->isNotEmpty())
                  <img src="{{ asset('storage/' .$faqPageData->cms->images->first()->path) }}" alt="banner" style="height: 300px; margin-bottom: 15px;">
         @else
                <img src="{{ asset('front/images/banner.jpg') }}" alt="banner" style="height: 300px; margin-bottom: 15px;">
         @endif
				</div>
            </div>
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a> </li>
            <li><a href="{{ route('faqs') }}">FAQ</a> </li>
        </ul>
    </div>    
</div>
@include('front.common.faq-section')
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script>
function changeTab(categoryId) {
    $('.faq_box').hide();
    $('#category_' + categoryId).show();
}

var faqIcons = {
        plus: "{{ asset('front/images/jam_plus.svg') }}",
        minus: "{{ asset('front/images/jam_minus.svg') }}"
    };

</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($faqs as $index => $faq)
    {
      "@type": "Question",
      "name": "{{ addslashes($faq->question) }}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{ addslashes($faq->answers[0]->answer ?? '') }}"
      }
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>

@endsection('content')