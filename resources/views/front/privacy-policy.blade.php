@extends('front.layouts.layout')
@section('content')
<!-- <div class="banneranimationbox" >
                <div class="container">
                @if ($page->cms && $page->cms->images->isNotEmpty())
                  <img src="{{ asset('storage/' .$page->cms->images->first()->path) }}" alt="">
                @else  
                  <img src="{{asset('front/images/banner.jpg')}}" alt="">
				@endif
				</div>
            </div> -->
			
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{route('home')}}">Home</a> </li>
            <li><a href="{{route('privacy.policy')}}">Privacy Policy</a> </li>
        </ul>
    </div>    
</div>
<section class="termandconditions">
    <div class="container">
        <div class="main_title"><h2>{{$page->cms->title}}</h2></div>
        {!! preg_replace('/\s+/', ' ', trim(strip_tags(html_entity_decode($page->cms->content), '<b><i><u><strong><em><p><ul><li>'))) !!}
    </div>
</section>
@endsection