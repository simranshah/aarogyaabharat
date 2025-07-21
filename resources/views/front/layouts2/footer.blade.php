
 <footer class="footer">
                                  <div class="div-3">
                                    <div class="all_footer_parts">
                                      <div class="footer_acco_box">
                                        <div class="acco_click">
                                          <a href="#;">
                                            <p>Quick links</p>
                                            <img src="{{ asset('front/images/upArrow.svg') }}" alt="upArrow" />
                                          </a>
                                        </div>
                                        <div class="acco_text">
                                          <div class="footer_links">
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('customer.about.us') }}">About</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('blogs') }}">Blogs</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('faqs') }}">FAQ's</a>
                                                </li>
                                              </ul>
                                            </div>
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('write.to.us') }}">Write For Us</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('front.contact') }}">Contact us</a>
                                                </li>
                                {{--
                                                <li>
                                                  <a href="{{ route('faqs') }}">Frequently Asked Questions</a>
                                                </li>
                                                <li>
                                                  <a href="{{ route('front.contact') }}">Contact us</a>
                                                </li> --}}

                                              </ul>
                                            </div>
                                            <div class="links_text">
                                              <ul>
                                                <li>
                                                  <a href="{{ route('terms.and.conditions') }}">Terms and Condtions</a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="footer_acco_box">
                                        <div class="acco_click">
                                          <a href="#;">
                                            <p>Popular Products</p>
                                            <img src="{{ asset('front/images/upArrow.svg') }}" alt="upArrow" />
                                          </a>
                                        </div>
                                        <div class="acco_text">
                                          <div class="Products_tag">
                        @if (isset($popularProducts))

                                            <ul>
                                @foreach ($popularProducts as $product)

                                              <li>
                                                <a href="{{ route('products.sub.category.wise', ['slug' => $product->category->slug,'subSlug'=>$product->slug]) }}">
                                                  <p>{{ $product->name }}</p>
                                                  <!-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"> -->
                                                </a>
                                              </li>
                                @endforeach

                                            </ul>
                        @endif

                                          </div>
                                        </div>
                                      </div>
                                      <div class="footer_acco_box">
                                        <div class="acco_click">
                                          <a href="#;">
                                            <p>Social connects</p>
                                            <img src="{{ asset('front/images/upArrow.svg') }}" alt="upArrow" />
                                          </a>
                                        </div>
                                        <div class="acco_text">
                                          <div class="social_connects">
                                            <ul>
                                              <li>
                                                <a href="{{ env('FACEBOOK_PAGE_URI') }}">
                                                  <img
                                        src="{{ asset('front/images/facebook.svg') }}" alt="Facebook" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="{{ env('INSTA_PAGE_URI') }}">
                                                  <img src="{{ asset('front/images/insta.svg') }}"
                                        alt="Insta" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="{{ env('X_PAGE_URI') }}">
                                                  <img src="{{ asset('front/images/Xtwit.svg') }}"
                                        alt="X" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="{{ env('YOUTUBE_PAGE_URL') }}" target="_blank">
                                                  <img
                                src="{{ asset('front/images/youtube.png') }}" alt="youtube" />
                                                </a>
                                              </li>
                                              <li>
                                                <a href="https://wa.me/{{ env('HELP_LINE_NO') }}" target="_blank">
                                                  <img
                                        src="{{ asset('front/images/whatsapp.svg') }}" alt="WhatsApp" />
                                                </a>
                                              </li>
                                            </ul>
                                          </div>
                                          <!-- <div class="emergency_help"><h2>Need an emergency help</h2><ul><li><a href="tel:{{ env('HELP_LINE_NO') }}"><img src="{{ asset('front/images/phone_call.svg') }}" alt="" /><p>{{ env('HELP_LINE_NO') }}</p><span>Call Now</span></a></li><li><a href="mailto:{{ env('HELP_LINE_EMAIL') }}"><img src="{{ asset('front/images/mail.svg') }}" alt="" /><p>{{ env('HELP_LINE_EMAIL') }}</p></a></li></ul></div> -->
                                        </div>
                                        <div class="emergency_help">
                                          <h2>Need an emergency help</h2>
                                          <ul>
                                            <li>
                                              <a href="tel:{{ env('HELP_LINE_NO') }}">
                                                <img
                                    src="{{ asset('front/images/phone_call.svg') }}" alt="phone_call" />
                                                <p>{{ env('HELP_LINE_NO') }}</p>
                                                <span>Call Now</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="mailto:{{ env('HELP_LINE_EMAIL') }}">
                                                <img
                                    src="{{ asset('front/images/mail.svg') }}" alt="mail" />
                                                <p>{{ env('HELP_LINE_EMAIL') }}</p>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="frame-120">
                                    <p class="text-wrapper-67">Copyrights © 2020 Aarogya Bharat</p>
                                  </div>
                                </footer>
                              </div>
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js" data-reload="true"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" data-reload="true"></script>
<script>
function reloadAllScripts() {
$('script[data-reload="true"]').each(function () {
var oldScript = $(this);
var newScript = document.createElement('script');
newScript.src = oldScript.attr('src') + '?v=' + new Date().getTime(); // cache-buster
newScript.setAttribute('data-reload', 'true');
document.body.appendChild(newScript);
oldScript.remove();
});
}
$(document).ready(function () {
$('.recent-product-products-slider').slick({
infinite: false,
slidesToShow: 7,
slidesToScroll: 1,

arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 5,
slidesToScroll: 1,
},
},
{
breakpoint: 768,
settings: {
slidesToShow: 3,
slidesToScroll: 1,
},
},
{
breakpoint: 480,
settings: {
slidesToShow: 2,
slidesToScroll: 1,
},
},
],
});
});


$(document).ready(function(){
$('.frame-15').slick({
infinite: false,
slidesToShow: 6,
slidesToScroll: 1,

arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 4,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 2,
slidesToScroll: 1
}
}
]
});
});
$(document).ready(function(){
$('.categories').slick({
infinite: false,
slidesToShow: 6,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 5,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 5,
slidesToScroll: 1
}
}
]
});
});
$(document).ready(function(){
$('.frame-44').slick({
infinite: false,
slidesToShow: 6,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 4,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 2,
slidesToScroll: 1
}
}
]
});
});
$(document).ready(function(){
$('.blogsimage').slick({
infinite: false,
slidesToShow: 4,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 3,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 2,
slidesToScroll: 1
}
}
]
});
});
$(document).ready(function(){
$('.raise-query-2').slick({
infinite: false,
slidesToShow: 3,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 2,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}
]
});
});
$(document).ready(function(){
$('.middle').slick({
infinite: false,
slidesToShow: 5,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 4,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}
]
});
});
$(document).ready(function(){
$('.frame-90').slick({
infinite: false,
slidesToShow: 3,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 2,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}
]
});
});
$(document).ready(function(){
$('.frame-95').slick({
infinite: false,
slidesToShow: 4,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 3,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
}
]
});
});
</script>
<script>
function toggleSidebar() {
                                    const sidebar = document.getElementById('sidebarMenu');
                                    const overlay = document.getElementById('overlay');

                                    // Toggle class
                                    sidebar.classList.toggle('open');
                                    overlay.classList.toggle('show');

                                    // Check if it now has the class 'open'
                                    if (sidebar.classList.contains('open')) {
                                      document.body.classList.add('noscroll');
                                    } else {
                                      document.body.classList.remove('noscroll');
                                    }
                                  }
$(document).ready(function() {
$('#searchInput').on('keyup', function() {
var query = $(this).val(); // Get the input value

if (query.length >= 2) { // Trigger search when at least 2 characters are entered
$.ajax({
url: "{{ route('search.products') }}", // Your route to search products
type: 'GET',
data: {
query: query // Send the input as a query parameter
},
success: function(response) {
if (response.success === false) {
    $('#searchResultList').html('<li>No products found.</li>');
} else {
    $('#searchResultList').html(response); // Render the results
}
$("#recentSearch").show()
},
error: function(xhr, status, error) {
console.error(error);
$('#searchResultList').html('<li>Something went wrong.</li>');
}
});
} else {
$('#searchResultList').empty(); // Clear results if query length is less than 2
}
});
});

</script>
<script>
const input1 = document.getElementById('searchInput');
const placeholderText = "Search best deals on medical equipment...";
let i = 0;

function typePlaceholder() {
if (i < placeholderText.length) {
input1.placeholder += placeholderText.charAt(i);
i++;
setTimeout(typePlaceholder, 100); // Adjust speed here (milliseconds)
}
}
// Start the animation
function resetPlaceholder() {
input1.placeholder = "";
i = 0;
typePlaceholder();
}
typePlaceholder();
input1.addEventListener('focus', resetPlaceholder);
input1.addEventListener('blur', resetPlaceholder);
// Loop the animation
input1.addEventListener('input', function() {
if (input1.value === "") {
resetPlaceholder();
}
});
// Restart typing animation when finished
let observer = new MutationObserver(function() {
if (i < input1.placeholder.length === placeholderText.length) {
setTimeout(resetPlaceholder, 1500); // Wait before restarting
}
});
observer.observe(input1, { attributes: true, attributeFilter: ['placeholder'] });

</script>
<script>
const input = document.getElementById('searchInput');
const dropdown = document.getElementById('recentSearch');

//   input.addEventListener('focus', () => {
//     dropdown.style.display = 'block';
//   });

document.addEventListener('click', (e) => {
if (!document.querySelector('.search-bar').contains(e.target)) {
dropdown.style.display = 'none';
}
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
const profileFrames = document.querySelectorAll(".profile-frame");
const total = profileFrames.length;
const half = Math.ceil(total / 2); // left side count
const rightCount = total - half;

let index = 0;

function updateRightFrames() {
for (let i = 0; i < rightCount; i++) {
// Reverse the left index
const leftIndex = (half + index - i - 1 + half) % half;
const left = profileFrames[leftIndex];
const right = profileFrames[i + half];

// Get data from left
const imgSrc = left.querySelector("img")?.getAttribute("src") || '';
const leftInner = left.querySelector("div[class^='frame-']");
const leftTextDivs = leftInner?.querySelectorAll("div") || [];
const name = leftTextDivs[0]?.innerText || '';
const desc = leftTextDivs[1]?.innerText || '';

// Set data to right
right.querySelector("img")?.setAttribute("src", imgSrc);
const rightInner = right.querySelector("div[class^='frame-']");
const rightTextDivs = rightInner?.querySelectorAll("div") || [];

if (rightTextDivs.length >= 2) {
rightTextDivs[0].innerText = name;
rightTextDivs[1].innerText = desc;
}
}

// Move backward
index = (index - 1 + half) % half;
}

updateRightFrames();
setInterval(updateRightFrames, 3000); // Rotate every 3 seconds
});

</script>
<script>
$(document).ready(function () {
$('.addtocart').on('click', function () {
var productId = $(this).data('id');
var $btn = $(this);
// $btn.prop('disabled', true).addClass('disabled');
$.ajax({
url: "{{ route('cart.add', ['productId' => '__ID__']) }}".replace('__ID__', productId),
method: 'POST',
data: {
_token: "{{ csrf_token() }}"
},
success: function (response) {
// ✅ Handle success (e.g., update cart count, show toast, etc.)
if(response.success){
document.getElementById('cartproductcount').innerHTML=response.cartproductcount;
document.getElementById('text-btween-cartpopup').innerHTML=response.message;
document.getElementById('text-btween-cartpopup').style.color='#2d5a2d';
cartPopup();
}else{
document.getElementById('text-btween-cartpopup').innerHTML=response.message;
document.getElementById('text-btween-cartpopup').style.color='red';
cartPopup();
}
$btn.prop('disabled', false).removeClass('disabled');
},
error: function (xhr) {
// ❌ Handle error
$btn.prop('disabled', false).removeClass('disabled');
document.getElementById('logoutPopup3').style.display='flex';
}
});
});
});
function cartPopup() {
// const cartBtn = document.getElementById('cartBtn');
const cartPopup = document.getElementById('cartPopup');

// cartCount++;
// cartBtn.textContent = `Cart (${cartCount})`;

cartPopup.style.display = 'flex';

// Hide the popup after 3 seconds
setTimeout(() => {
cartPopup.style.display = 'none';
}, 3000);
}
</script>
<script>
function changeProductsByCategory(categoryId) {
console.log("Selected category ID:", categoryId);
$.ajax({
url: "{{ route('products.category') }}",
type: 'GET',
data: { category_id: categoryId },
success: function(response) {
$('#category-products').html(response);

// Now reload all JS
//   document.querySelectorAll('script').forEach(function(oldScript) {
//               if (oldScript.src) {
//                   const newScript = document.createElement('script');
//                   newScript.src = oldScript.src;
//                   newScript.async = oldScript.async;
//                   document.body.appendChild(newScript);
//               }
//           });
},
error: function(xhr, status, error) {
console.error("Error fetching products:", error);
}
});
}
</script>

</html>
