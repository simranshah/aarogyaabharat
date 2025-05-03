<section class="frequently_asked_questions">
    <div class="container">
        <div class="faq_title"><h2>Frequently asked questions</h2></div>
        <div class="filter">
    <div class="filtertitle">
        <p>Filter</p>
        <img src="{{ asset('front/images/Filter.svg') }}" alt="" />
    </div>
    <ul>
        @if(isset($faqFilters))
        @foreach($faqFilters as $filter)
            <li>
                <a href="javascript:void(0);" onClick="changeTab('{{ $filter['id'] }}')">
                    <span>{{ $filter['name'] }}</span>
                    <img src="{{ asset('front/images/Vector_plus.svg') }}" alt="" />
                </a>
            </li>
        @endforeach
        @endif
    </ul>
</div>

        @if(isset($faqs))
        @foreach($faqs as $faq)
        @if($faq->category == 1)
        <div class="faq_box" id="category_{{$faq->category}}">
            <a href="javascript:void(0)"><p>{{$faq->question}}</p><img src="{{asset('front/images/jam_plus.svg') }}" alt="" /></a>
            <div class="faq_box_text">
                <p>{{$faq->answers[0]->answer}}</p>
            </div>
        </div>
        @endif
        @if($faq->category == 2)
        <div class="faq_box" id="category_{{$faq->category}}" style="display: none;">
            <a href="javascript:void(0)"><p>{{$faq->question}}</p><img src="{{asset('front/images/jam_plus.svg') }}" alt="" /></a>
            <div class="faq_box_text">
                <p>{{$faq->answers[0]->answer}}</p>
            </div>
        </div>
        @endif
        @if($faq->category == 3)
        <div class="faq_box" id="category_{{$faq->category}}" style="display: none;">
            <a href="javascript:void(0)"><p>{{$faq->question}}</p><img src="{{asset('front/images/jam_plus.svg') }}" alt="" /></a>
            <div class="faq_box_text">
                <p>{{$faq->answers[0]->answer}}</p>
            </div>
        </div>
        @endif
        @if($faq->category == 4)
        <div class="faq_box" id="category_{{$faq->category}}" style="display: none;">
            <a href="javascript:void(0)"><p>{{$faq->question}}</p><img src="{{asset('front/images/jam_plus.svg') }}" alt="" /></a>
            <div class="faq_box_text">
                <p>{{$faq->answers[0]->answer}}</p>
            </div>
        </div>
        @endif
        @endforeach
        @endif
    </div>
</section>