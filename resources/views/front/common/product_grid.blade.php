@foreach ($categoriesAndProducts as $category)
@foreach ($category->products as $product)
              <div class="frame-16">
                <div class="overlap-group-wrapper">
                  <div class="overlap">
                    <a href="{{ route('products.sub.category.wise', ['slug' => $category->slug,'subSlug'=>$product->slug]) }}">
                      <div class="rectangle">
                        <img style="height: 90%;width: 90%;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                      </div>
                    </a>
                    <div class="group-2">
                      <div class="overlap-group">
                        <div class="text-wrapper-9">Best Seller</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="frame-17">
                  <div class="frame-wrapper">
                    <div class="wheel-chair-hashtag-wrapper">
                      <a href="{{ route('products.sub.category.wise', ['slug' =>$category->slug,'subSlug'=>$product->slug]) }}">
                        <p class="wheel-chair-hashtag">
      {{ Str::limit($product->name, 40) }}
    </p>
                      </a>
                    </div>
                  </div>
                  <div class="frame-18">
                    <div class="frame-19">
                      <div class="frame-20">
                        <div class="frame-21">
                          <div class="text-wrapper-11">₹ @indianCurrency($product->our_price)</div>
                          <div class="text-wrapper-12">₹ @indianCurrency($product->original_price)</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="frame-9">
                    <div class="frame-22">
                      <div class="text-wrapper-13">@indianCurrency($product->discount_percentage) % OFF</div>
                    </div>
                    <div class="frame-23">
                      <div class="frame-24">
                        <svg
                          xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                          <path d="M8.94377 7.02453L5.64575 5.11307L7.30837 1.12293C7.36639 1.00442 7.39339 0.873133 7.38686 0.741345C7.38032 0.609557 7.34046 0.481581 7.27101 0.369392C7.20155 0.257203 7.10476 0.164468 6.98971 0.0998659C6.87466 0.0352635 6.7451 0.000904968 6.61315 5.51437e-06C6.43776 -0.000654732 6.2673 0.0579921 6.12945 0.166423L6.07501 0.213082L0.242625 5.73441C0.154947 5.81767 0.0878507 5.9202 0.046644 6.03388C0.00543737 6.14756 -0.0087485 6.26926 0.00520861 6.38937C0.0191657 6.50947 0.0608829 6.62469 0.127059 6.72588C0.193236 6.82708 0.282055 6.91149 0.38649 6.97243L3.68529 8.88545L2.00323 12.9215C1.93385 13.0861 1.92333 13.2696 1.97344 13.4411C2.02355 13.6126 2.13123 13.7615 2.27835 13.8629C2.42546 13.9643 2.60301 14.0118 2.78109 13.9976C2.95917 13.9833 3.1269 13.9081 3.25602 13.7847L9.08841 8.26178C9.1759 8.17845 9.24282 8.07593 9.28387 7.9623C9.32493 7.84867 9.33899 7.72705 9.32496 7.60705C9.31094 7.48704 9.26919 7.37195 9.20304 7.27085C9.13688 7.16976 9.04812 7.08543 8.94377 7.02453Z" fill="#F24F67"/>
                        </svg>
                        <div class="text-wrapper-14">Get it May 29</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="frame-25">
                  <div class="frame-26">
                    <div class="text-wrapper-15 addtocart" onclick="addToCart({{ $product->id }})" data-id="{{ $product->id }}">Add to cart</div>
                  </div>
                </div>
              </div>
@endforeach
@endforeach
