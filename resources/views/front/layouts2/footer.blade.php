@php
$isMobile =
request()->header('User-Agent') &&
preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
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
                <a href="https://www.facebook.com/people/Aarogyaabharat/61572967197556/" target="_blank">
                  <img
        src="{{ asset('front/images/facebook.svg') }}" alt="Facebook" />
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/aarogyaabharat/" target="_blank">
                  <img src="{{ asset('front/images/insta.svg') }}"
        alt="Insta" />
                </a>
              </li>
              <li>
                <a href="https://x.com/aarogyaabharat" target="_blank">
                  <img src="{{ asset('front/images/Xtwit.svg') }}"
        alt="X" />
                </a>
              </li>
              <li>
                <a href="https://www.youtube.com/@aarogyaabharat" target="_blank">
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
    <div class="footer-payment-row" style="display: flex; align-items: center; margin-top: 0px;">
    @if(!$isMobile)
    <div style="font-size: 15px; color: #222; margin-right: 32px;">
       Payment Methods
    </div>
    @endif
</div>
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; margin-top:0; width: 100%;">
  <!-- Left-side payment logos -->
  <div class="footer-payment-row" style="display: flex; align-items: center;">
    <img src="{{ asset('front/images/visa.png') }}" alt="Visa" style="height: 32px; margin-right: 10px;">
    <img src="{{ asset('front/images/rupay.png') }}" alt="Rupay" style="height: 32px; margin-right: 10px;">
    <img src="{{ asset('front/images/mastercard.png') }}" alt="MasterCard" style="height: 32px;">
  </div>

  <!-- Right-side PCI logo -->
  <div style="margin-left: auto;     margin-top: 20px;
">
    <img src="{{ asset('front/images/pci.webp') }}" alt="PCI certified" style="height: 50px;">
    <img src="{{ asset('front/images/iso_certified.png') }}" alt="iso_certified" style="height: 50px;">
  </div>
</div>


</footer>

</div>
<div class="frame-120">
  <p class="text-wrapper-67">Copyrights © 2020 Aarogyaa Bharat</p>
</div>

<div id="notification-pop">

</div>
<div class="flash-sale-popup-overlay" onclick="this.style.display='none'" id="flash-sale-popup-overlay">
<div class="flash-sale-popup" onclick="event.stopPropagation()">
    <div class="flash-sale-popup-header">
        <div class="flash-sale-close-btn"
            onclick="document.querySelector('.flash-sale-popup-overlay').style.display='none'">&times;</div>
        <h2>FLASH Offer</h2>
        <p>Limited Time Offer</p>
    </div>
    <div class="flash-sale-popup-body">
        <h3>Introductory Special Discount</h3>
        <div class="flash-sale-discount">70% OFF</div>
        <p class="flash-sale-desc">On Bestselling medical equipment</p>
        <div class="flash-sale-timer">
            <div class="flash-sale-timer-box">
                <span id="hrs">12</span>
                <small>Hours</small>
            </div>
            <div class="flash-sale-timer-box">
                <span id="mins">00</span>
                <small>Minutes</small>
            </div>
            <div class="flash-sale-timer-box">
                <span id="secs">00</span>
                <small>Seconds</small>
            </div>
        </div>
        <a href="{{ route('products.flash.sale') }}"><button class="flash-sale-shop-btn">Shop
                Now</button></a>
    </div>
</div>
</div>
@if ( !Route::is('products.sub.category.wise'))
<div id="chat-toggle">
<img src="{{ asset('front/images/chat_bot_img.png') }}" alt="Chat Icon">
</div>
@endif
<div class="log-out">
<div class="popup-overlay" id="logoutPopup3" style="display: none;">
<div class="popup">
<button class="close-btn" onclick="document.getElementById('logoutPopup3').style.display='none';">&times;</button>
<img src="{{asset('front/images/server_isuue.svg')}}" alt="Logout" class="popup-image1" />
{{-- <h2 class="popup-title">Come back soon!</h2> --}}
<p class="popup-text">Something Went Wrong !</p>
<div class="popup-buttons">
<a href="{{route('raise.query')}}"><button class="btn yes-btn" style="padding: 10px 1px;" >Raise Query</button></a>
<button class="btn cancel-btn" onclick="document.getElementById('logoutPopup3').style.display='none';">Cancel</button>
</div>
</div>
</div>
</div>
<!-- Chat Popup -->
<div class="chat-popup" id="chatbox">
<div class="chat-header">
    <img src="{{ asset('front/images/samll_chat_gpt.svg') }}" alt="Bot">
    <span>Aarogyaa</span>
    <div class="close-btn" id="close-chat">✕</div>
</div>
<div class="chat-body" id="chat-body"></div>
<div class="chat-input">
    <button id="add-btn">+</button>
    <input type="text" id="chat-input" placeholder="Ask Aarogyaa..." />
    <button id="send-btn">➤</button>
</div>
</div>
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/script.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" data-reload="true"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" data-reload="true"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-D1GEF2BB22"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-D1GEF2BB22');
</script>
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
slidesToShow: 5.5,
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

dots: true,
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
slidesToShow:5 ,
slidesToScroll: 4
}
}
]
});
});
$(document).ready(function(){
// Count the number of direct child divs inside .frame-44
var itemCount = $('.frame-44 > div').length;

if(itemCount >= 6) {
$('.frame-44').slick({
infinite: false,
slidesToShow: 6,
slidesToScroll: 2,
autoplay: true,
autoplaySpeed: 2000,
arrows: false,
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
}
});
$(document).ready(function () {
var $carousel = $('.everyonebuying');
var count = parseInt($carousel.data('count'));

if (count > 1) {
$carousel.slick({
infinite: false,
slidesToShow: count < 3.5 ? count : 3.5, // cap at count if fewer than 3.5
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 2000,
arrows: false,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: count < 3 ? count : 3,
slidesToScroll: 1
}
},
{
breakpoint: 768,
settings: {
slidesToShow: count < 1.5 ? count : 1.5,
slidesToScroll: 1
}
}
]
});
}
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
{{-- $(document).ready(function(){
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
}); --}}
@if($isMobile)
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
@endif
{{-- $(document).ready(function(){
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
}); --}}
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
$(document).ready(function(){
$('.banner-container').slick({
infinite: false,
slidesToShow: 1,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 2000,
arrows: false, // 👈 hides next/prev buttons
dots: true,
responsive: [
{
breakpoint: 1024,
settings: {
slidesToShow: 1,
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
      $("#recentSearch").hide();
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
function changeProductsByCategory(categoryId,clickedElement) {
console.log("Selected category ID:", categoryId);
$.ajax({
url: "{{ route('products.category') }}",
type: 'GET',
data: { Brand_id: categoryId },
success: function(response) {
$('#category-products').html(response);

// Now reload all JS
document.querySelectorAll('script').forEach(function(oldScript) {
document.querySelectorAll('.category-tab').forEach(function(el) {
el.classList.remove('frame-58');
el.classList.add('frame-59');
});

// Add frame-58 to the clicked one
clickedElement.classList.remove('frame-59');
clickedElement.classList.add('frame-58');
if (oldScript.src) {
const newScript = document.createElement('script');
newScript.src = oldScript.src;
newScript.async = oldScript.async;
document.body.appendChild(newScript);
}
});
},
error: function(xhr, status, error) {
console.error("Error fetching products:", error);
}
});
}
$('.notificationpopupjs').click(function() {
$.ajax({
url: '{{ route('customer.notification') }}',
method: 'GET',
success: function(data) {
if (data.notificationHtml) {
$('#notification-pop').html(data.notificationHtml);
$('.notificationPop').css('display', 'flex');
} else {
// toastr.error('No notifications found.');
}
},
error: function(xhr) {
if (xhr.status === 401) {
// toastr.error('Please log to see your notifications.');
} else {
// toastr.error('No notifications found.');
}
}
});
});
$('.notificationBlock > a').click(function() {
$('.notificationPop').hide();
});

function closeonotificationPopUp() {
$('.notificationPop').hide();
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
var toggleBtn = document.getElementById('categoryToggleBtn');
var subMenu = document.getElementById('categorySubMenu');
var isOpen = true;

toggleBtn.addEventListener('click', function() {
isOpen = !isOpen;
subMenu.style.display = isOpen ? 'block' : 'none';
toggleBtn.textContent = isOpen ? '-' : '+';
});
});
</script>
<script>
const toggleBtn = document.getElementById('chat-toggle') || document.getElementById('chat-toggle-button');
const closeBtn = document.getElementById('close-chat');
const chatbox = document.getElementById('chatbox');
const chatBody = document.getElementById('chat-body');
const chatInput = document.getElementById('chat-input'); // renamed from input
const sendBtn = document.getElementById('send-btn');

let lastQuery = "";
let typingEl;

function formatMarkdown(text) {
return text
.replace(/</g, "&lt;") // escape to prevent XSS
.replace(/>/g, "&gt;")
.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
}

function addMessage(text, sender = "user") {
const wrapper = document.createElement("div");
wrapper.className = `message-wrapper ${sender}`;

if (sender === "bot") {
chatInput.disabled = false;

const botRow = document.createElement("div");
botRow.className = "bot-row";
botRow.style.display = "flex";
botRow.style.alignItems = "center";
botRow.style.gap = "8px";

const botImage = document.createElement("img");
botImage.src = "/front/images/msg_chat_bot.svg"; // Use actual path
botImage.alt = "Bot";
botImage.className = "bot-image";

const msg = document.createElement("div");
msg.className = "message";
msg.innerHTML = formatMarkdown(text);

botRow.appendChild(botImage);
botRow.appendChild(msg);
wrapper.appendChild(botRow);
} else {
chatInput.disabled = true;

const name = document.createElement("div");
name.className = "sender-name";
name.textContent = "You :";

const msg = document.createElement("div");
msg.className = "message";
msg.innerHTML = formatMarkdown(text);

wrapper.appendChild(name);
wrapper.appendChild(msg);
}

chatBody.appendChild(wrapper);
chatBody.scrollTop = chatBody.scrollHeight;
}

function showTypingIndicator() {
typingEl = document.createElement("div");
typingEl.className = "message-wrapper bot";

const typingText = document.createElement("div");
typingText.className = "typing-indicator";
typingText.innerHTML = `
<div class="typing-wrapper">
<span class="typing-dots">
<span class="dot"></span>
<span class="dot"></span>
<span class="dot"></span>
</span>
</div>`;

typingEl.appendChild(typingText);
chatBody.appendChild(typingEl);
chatBody.scrollTop = chatBody.scrollHeight;
}

function hideTypingIndicator() {
if (typingEl) {
chatBody.removeChild(typingEl);
typingEl = null;
}
}

async function handleSend() {
const userInput = chatInput.value.trim();
if (!userInput) return;

addMessage(userInput, "user");
chatInput.value = "";

showTypingIndicator();

try {
const payload = { query: userInput };
if (lastQuery) payload.old_query = lastQuery;

const response = await fetch("https://chatbot-abl-1.onrender.com/chat", {
method: "POST",
headers: {
"Content-Type": "application/json"
},
body: JSON.stringify(payload)
});

const data = await response.json();
const reply = data.response;

hideTypingIndicator();
addMessage(reply, "bot");

if (reply.includes("I couldn't find a matching product")) {
lastQuery = userInput;
} else {
lastQuery = "";
}
} catch (err) {
hideTypingIndicator();
addMessage("⚠️ Could not connect to server.", "bot");
}
}

sendBtn.addEventListener("click", handleSend);
chatInput.addEventListener("keypress", (e) => {
if (e.key === "Enter") handleSend();
});

toggleBtn.addEventListener("click", () => {
chatbox.style.display = "flex";
if(document.getElementById('chat-toggle')!=null){
toggleBtn.style.display = "none";
}
});

closeBtn.addEventListener("click", () => {
chatbox.style.display = "none";
if(document.getElementById('chat-toggle')!=null){ 
toggleBtn.style.display = "block";
}
});

// Initial bot greeting
addMessage("Hi! I'm Aarogyaa. How can I help you today?", "bot");

function searchproductinput(searchvalue) {
            // var checkworld= checkSpelling(searchvalue);
            var url = '{{ url('/search/products/results/') }}/' + searchvalue;
            window.location.href = url;
        }
      
    document.addEventListener("DOMContentLoaded", function () {
        const img = document.querySelector('.raise-query-img');

        if (!img) return;

        const deviceWidth = window.innerWidth;
        const isMobile = img.classList.contains('mobile');

        const adjustedWidth = isMobile ? deviceWidth - 20 : deviceWidth - 100;
        img.style.width = adjustedWidth + 'px';
    });


</script>

</html>
