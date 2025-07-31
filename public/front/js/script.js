// Filter button functionality


function getCodeBoxElement(s) {
    return document.getElementById("codeBox" + s);
}
function onFocusEvent(s) {
    for (item = 1; item < s; item++) {
        let e = getCodeBoxElement(item);
        if (!e.value) {
            e.focus();
            break;
        }
    }
}
$(document).ready(function () {
    if ($(".otp-wrap").length > 0) {
        var s;
        (function s(e) {
            var t = document.getElementById(e).children,
                o = null;
            function r() {
                for (i = 0; i < t.length; i++) n(i, t[i]);
            }
            function n(s, e) {
                e.addEventListener("input", function (e) {
                    (function s(e, r) {
                        var n = r.data || r.target.value,
                            d = e;
                        for (i = 0; i < n.length; i++)
                            if (i < t.length) {
                                if (!a(n[i])) {
                                    t[d].value = "";
                                    break;
                                }
                                (t[d++].value = n[i]), d == t.length ? h() && o(l()) : t[d].focus();
                            }
                    })(s, e);
                }),
                    e.addEventListener("paste", function (e) {
                        (function s(e, r) {
                            r.preventDefault();
                            var n = e,
                                h = (r.clipboardData || window.clipboardData).getData("Text");
                            for (i = 0; i < h.length; i++)
                                if (i < t.length) {
                                    if (!a(h[i])) break;
                                    (t[n].value = h[i]), n++;
                                }
                            n == t.length ? (t[n - 1].focus(), o(l())) : t[n].focus();
                        })(s, e);
                    }),
                    e.addEventListener("keydown", function (e) {
                        var r, n, a;
                        (r = s),
                            (n = e),
                            5 == r && $("#otp-inputs input").siblings(".errormsg").hide(),
                            5 == r &&
                                setTimeout(function () {
                                    $("#otp_form .submitBTN").trigger("click");
                                }, 200),
                            (a = n.keyCode || n.which),
                            37 == a && r > 0 && (n.preventDefault(), t[r - 1].focus()),
                            39 == a && r + 1 < t.length && (n.preventDefault(), t[r + 1].focus()),
                            8 == a && r > 0 && ("" == t[r].value ? ((t[r - 1].value = ""), t[r - 1].focus()) : (t[r].value = "")),
                            13 == a && (n.preventDefault(), h() && o(l())),
                            9 == a && r == t.length - 1 && (n.preventDefault(), h() && o(l()));
                    });
            }
            function l() {
                var s = "";
                for (i = 0; i < t.length; i++) s += t[i].value;
                return s;
            }
            function a(s) {
                return s >= "0" && s <= "9";
            }
            function h() {
                for (var s = !0, e = 0; e < t.length && s; ) "" == t[e].value && (s = !1), e++;
                return s;
            }
            return {
                init: function s(e) {
                    for (i = 0, o = e; i < t.length; i++) n(i, t[i]);
                },
            };
        })("otp-inputs").init(function (s) {
            $("#otp-inputs input").blur();
        });
    }
    if (
        ($(".bannerSlider").slick({
            dots: !0,
            infinite: !1,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 1, slidesToScroll: 1, dots: !0, arrows: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 } },
                { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 } },
            ],
        }),
        $(".offer_slider").slick({
            dots: !0,
            infinite: !1,
            speed: 300,
            slidesToShow: 2.59,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2.2, slidesToScroll: 1, dots: !0, arrows: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1.1, slidesToScroll: 1, arrows: !1 } },
                { breakpoint: 480, settings: { slidesToShow: 1.1, slidesToScroll: 1, arrows: !1 } },
            ],
        }),
        $(".product_slider").slick({
            dots: !0,
            infinite: !1,
            speed: 300,
            slidesToShow: 3.95,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2.5, slidesToScroll: 1, dots: !0, arrows: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1.2, slidesToScroll: 1, arrows: !1 } },
                { breakpoint: 480, settings: { slidesToShow: 1.2, slidesToScroll: 1, arrows: !1 } },
            ],
        }),
        $(".product_slider2").slick({
            dots: !0,
            infinite: !1,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2.5, slidesToScroll: 1, dots: !0, arrows: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1.2, slidesToScroll: 1, arrows: !1 } },
                { breakpoint: 480, settings: { slidesToShow: 2.6, slidesToScroll: 1, arrows: !1 } },
            ],
        }),
        $(".customerSlider").slick({
            dots: !0,
            infinite: !1,
            speed: 300,
            slidesToShow: 2.65,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2.2, slidesToScroll: 1, dots: !0, arrows: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1.2, slidesToScroll: 1, arrows: !1 } },
                { breakpoint: 480, settings: { slidesToShow: 1.2, slidesToScroll: 1, arrows: !1 } },
            ],
        }),
        $(".catgory_slider").slick({
            dots: !0,
            infinite: !1,
            speed: 300,
            slidesToShow: 2.65,
            slidesToScroll: 1,
            variableWidth: !0,
            width: 12.5,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 2.2, slidesToScroll: 1, dots: !1, arrows: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1.2, slidesToScroll: 1, arrows: !1 } },
                { breakpoint: 480, settings: { slidesToShow: 1.2, slidesToScroll: 1, arrows: !1 } },
            ],
        }),
        $(".catgory_slider").on("setPosition", function () {
            $(".catgory_slider .slick-slide").css("width", "151px");
        }),
        $(".slick-dots ").css("display", "none"),
        $(".slide_product").slick({
            dots: !1,
            infinite: !1,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                { breakpoint: 1024, settings: { slidesToShow: 1, slidesToScroll: 1, infinite: !0, dots: !0, arrows: !1 } },
                { breakpoint: 600, settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 } },
                { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1, arrows: !1 } },
            ],
        }),
        769 > $(window).width() && $(".why_arogya_bharat_all_box").slick({ dots: !0, infinite: !1, speed: 300, slidesToShow: 1, slidesToScroll: 1, arrows: !1 }),
        $(".progressBar").html("<div></div>"),
        $(".getprogressWidth").each(function () {
            var s = $(this).find(".slick-dots li").length;
            $(this)
                .siblings(".progressBar")
                .find("div")
                .css("width", 100 / s + "%");
        }),
        $(".getprogressWidth").on("afterChange", function () {
            var s, e, t;
            (s = $(this)),
                (e = s.find(".slick-dots li").length),
                (t = s.find(".slick-active").index() + 1),
                console.log(t),
                s
                    .siblings(".progressBar")
                    .find("div")
                    .css("width", (100 / e) * t + "%");
        }),
        $(".SearchBlock input").keyup(function () {
            $(this).val().length > 0 ? ($(this).siblings("a").show(), $(".searchPop").fadeIn()) : ($(this).siblings("a").hide(), $(".searchPop").hide()),
                768 >= $(window).width() &&
                    ($(this).val().length > 0
                        ? ($(this).parents(".SearchBlock").siblings("#customerlocationPin").find(".locationPin").hide(), $(this).parents(".SearchBlock").css("width", "90%"), $(this).parents(".SearchBlock").children("a").show())
                        : ($(this).parents(".SearchBlock").siblings("#customerlocationPin").find(".locationPin").delay(10).fadeIn(10),
                          $(this).parents(".SearchBlock").removeAttr("style"),
                          $(this).parents(".SearchBlock").children("a").hide())),
                "none" == $(".winScrollStop").css("display") ? $("body").css("overflow-y", "auto") : $("body").css("overflow-y", "hidden");
        }),
        $(".searchPop").click(function () {
            $(".searchPop").hide();
        }),
        $(".locationPin").click(function () {
            $(".locationPop").css("display", "flex");
        }),
        $(".locationBlock > a").click(function () {
            $(".locationPop").hide();
        }),
        $(window).click(function () {
            var s = 0;
            $(".winScrollStop").each(function () {
                "none" != $(this).css("display") && s++;
            }),
                s > 0 ? $("body").css("overflow-y", "hidden") : $("body").css("overflow-y", "auto");
        }),
        $(".headerBlock").length > 1)
    ) {
        var e = $(".SearchBlock").offset().left;
        $(window).width() > 768 && $(".searchPopBlock").css("margin-left", e + "px");
    }
    $(".SearchBlock > a").click(function () {
        $(this).siblings("div").children("input").val(""), $(this).siblings("div").children("a").hide(), $(".searchPop").hide(), $(".locationPin").delay(500).fadeIn(), $(".SearchBlock").removeAttr("style"), $(this).hide();
    });
    var t = function (s) {
        if (s.files && s.files[0]) {
            var e = new FileReader();
            (e.onload = function (s) {
                $(".uploadeedImg").attr("src", s.target.result), $(".fileUpload").hide(), $(".uploadedPart").css("display", "flex"), $(".uploadedPart").siblings(".errormsg").hide();
            }),
                e.readAsDataURL(s.files[0]);
        }
    };
    function o(s, e) {
        e && $(s).siblings(".errormsg").text(e);
    }
    $(".file-upload").on("change", function () {
        t(this);
    }),
        $(".uploadedPart .imgDis a").click(function () {
            $(".file-upload").val(""), $(".uploadedPart").hide(), $(".fileUpload").show();
        }),
        $(".submitBTN").click(function (s) {
            var e, t, r, n;
            s.preventDefault(),
                (t = (e = $(this)).parents("form").attr("id")),
                (r = 0),
                $("#" + t + " .inputMainBlock input,#" + t + " .inputMainBlock textarea").each(function () {
                    if (!$(this).hasClass("nomandetory") && !$(this).attr("disabled")) {
                        if ("" == $(this).val()) $(this).parents(".inputMainBlock").find(".errormsg").show(), o(this);
                        else if ($(this).hasClass("mobileVD")) {
                            var s = $(this).val();
                            s.length < 10 || s.length > 10
                                ? ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this, "Please enter a valid 10-digit mobile number"))
                                : s.indexOf(".") > -1
                                ? ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this, "Please enter a valid 10-digit mobile number"))
                                : 9 == s.substr(0, 1) || 8 == s.substr(0, 1) || 7 == s.substr(0, 1) || 6 == s.substr(0, 1) || 5 == s.substr(0, 1)
                                ? ($(this).parents(".inputMainBlock").find(".errormsg").hide(), o(this))
                                : ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this, "Please enter a valid 10-digit mobile number"));
                        } else if ($(this).hasClass("FullNameVD")) {
                            var e = $(this).val().trim();
                            (e = e.replace(/\s\s+/g, " ")), $(this).val(e);
                            var [t, n, l] = e.split(" "),
                                a = "",
                                h = "",
                                d = "",
                                c = "",
                                p = "",
                                u = "";
                            t && ((a = t.substr(0, 1)), (h = t.substr(1, 2)), (t = t.toLowerCase())),
                                n && ((d = n.substr(0, 1)), (c = n.substr(1, 2)), (n = n.toLowerCase())),
                                l && ((p = l.substr(0, 1)), (u = l.substr(1, 2)), (l = l.toLowerCase())),
                                /^[a-zA-Z .]*$/g.test($(this).val())
                                    ? 1 == $(this).val().split(" ").length
                                        ? ($(this).siblings(".errormsg").show(), o(this, "Enter valid full name"))
                                        : 1 == t.length && 1 == n.length && 1 == l.length
                                        ? ($(this).siblings(".errormsg").show(), o(this, "Enter valid full name"))
                                        : 2 == t.length && 2 == n.length && 2 == l.length
                                        ? a == h && d == c && p == u && ($(this).siblings(".errormsg").show(), o(this, "Enter valid full name"))
                                        : t == n
                                        ? ($(this).siblings(".errormsg").show(), o(this, "First Name and Middle Name cannot be same"))
                                        : t == l
                                        ? ($(this).siblings(".errormsg").show(), o(this, "First Name & Last Name cannot be same"))
                                        : n == l
                                        ? ($(this).siblings(".errormsg").show(), o(this, "Middle Name and last name cannot be same"))
                                        : $(this).val().split(" ").length > 3
                                        ? ($(this).siblings(".errormsg").show(), o(this, "More than 2 spaces are not allowed"))
                                        : ($(this).siblings(".errormsg").hide(), o(this))
                                    : ($(this).siblings(".errormsg").show(), o(this, "Only alphabets are allowed"));
                        } else if ($(this).hasClass("emailVD")) {
                            var g = $(this).val();
                            /^[A-Za-z0-9!#%&\'*+-/=?^_`{|}~]+@[A-Za-z0-9-]+(\.[AZa-z0-9-]+)+[A-Za-z]$/.test(g)
                                ? ($(this).siblings(".errormsg").hide(), o(this, "VDtrue"))
                                : ($(this).siblings(".errormsg").show(), r++, o(this, "Enter valid Email ID"));
                        } else if ($(this).hasClass("AnyValueVD")) {
                            var s = $(this).val();
                            s ? ($(this).parents(".inputMainBlock").find(".errormsg").hide(), o(this)) : ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this));
                        }
                    }
                });
        }),
        $(".inputMainBlock input,.inputMainBlock textarea").blur(function () {
            if (($(this), !$(this).hasClass("nomandetory") && !$(this).attr("disabled"))) {
                if ("" == $(this).val()) $(this).parents(".inputMainBlock").find(".errormsg").show(), o(this);
                else if ($(this).hasClass("mobileVD")) {
                    var s = $(this).val();
                    s.length < 10 || s.length > 10
                        ? ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this, "Please enter a valid 10-digit mobile number"))
                        : s.indexOf(".") > -1
                        ? ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this, "Please enter a valid 10-digit mobile number"))
                        : 9 == s.substr(0, 1) || 8 == s.substr(0, 1) || 7 == s.substr(0, 1) || 6 == s.substr(0, 1) || 5 == s.substr(0, 1)
                        ? ($(this).parents(".inputMainBlock").find(".errormsg").hide(), o(this))
                        : ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this, "Please enter a valid 10-digit mobile number"));
                } else if ($(this).hasClass("FullNameVD")) {
                    var e = $(this).val().trim();
                    (e = e.replace(/\s\s+/g, " ")), $(this).val(e);
                    var [t, r, n] = e.split(" "),
                        l = "",
                        a = "",
                        h = "",
                        d = "",
                        c = "",
                        p = "";
                    t && ((l = t.substr(0, 1)), (a = t.substr(1, 2)), (t = t.toLowerCase())),
                        r && ((h = r.substr(0, 1)), (d = r.substr(1, 2)), (r = r.toLowerCase())),
                        n && ((c = n.substr(0, 1)), (p = n.substr(1, 2)), (n = n.toLowerCase())),
                        /^[a-zA-Z .]*$/g.test($(this).val())
                            ? 1 == $(this).val().split(" ").length
                                ? ($(this).siblings(".errormsg").show(), o(this, "Enter valid full name"))
                                : 1 == t.length && 1 == r.length && 1 == n.length
                                ? ($(this).siblings(".errormsg").show(), o(this, "Enter valid full name"))
                                : 2 == t.length && 2 == r.length && 2 == n.length
                                ? l == a && h == d && c == p && ($(this).siblings(".errormsg").show(), o(this, "Enter valid full name"))
                                : t == r
                                ? ($(this).siblings(".errormsg").show(), o(this, "First Name and Middle Name cannot be same"))
                                : t == n
                                ? ($(this).siblings(".errormsg").show(), o(this, "First Name & Last Name cannot be same"))
                                : r == n
                                ? ($(this).siblings(".errormsg").show(), o(this, "Middle Name and last name cannot be same"))
                                : $(this).val().split(" ").length > 3
                                ? ($(this).siblings(".errormsg").show(), o(this, "More than 2 spaces are not allowed"))
                                : ($(this).siblings(".errormsg").hide(), o(this))
                            : ($(this).siblings(".errormsg").show(), o(this, "Only alphabets are allowed"));
                } else if ($(this).hasClass("emailVD")) {
                    var u = $(this).val();
                    /^[A-Za-z0-9!#%&\'*+-/=?^_`{|}~]+@[A-Za-z0-9-]+(\.[AZa-z0-9-]+)+[A-Za-z]$/.test(u)
                        ? ($(this).siblings(".errormsg").hide(), o(this, "VDtrue"))
                        : ($(this).siblings(".errormsg").show(), error++, o(this, "Enter valid Email ID"));
                } else if ($(this).hasClass("AnyValueVD")) {
                    var s = $(this).val();
                    s ? ($(this).parents(".inputMainBlock").find(".errormsg").hide(), o(this)) : ($(this).parents(".inputMainBlock").find(".errormsg").show(), o(this));
                }
            }
        }),
        $(".mobileVD").keyup(function (s) {
            var e = $(this).val();
            e.length > 10 && $(this).val(e.substr(0, 10));
        }),
        $("body").on("keydown", ".mobileVD", function () {
            k = event.which;
            var s = $(this).val();
            return ((s = s.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, "")), $(this).val(s), (k >= 48 && k <= 57) || (k >= 96 && k <= 105) || 8 == k || 9 == k)
                ? 10 == $(this).val().length
                    ? 8 == k || 9 == k || (event.preventDefault(), !1)
                    : void 0
                : (event.preventDefault(), !1);
        }),
        $(".inputMainBlock input").blur(function () {
            var s;
            (s = this),
                "pincode" !== $(s).attr("name") &&
                    ($(s).hasClass("nomandetory") ||
                        ("none" == $(s).siblings(".errormsg").css("display") ? $(s).parents(".inputMainBlock").addClass("valid").removeClass("invalid") : $(s).parents(".inputMainBlock").removeClass("valid").addClass("invalid")));
        }),
        $("#otp_form .submitBTN").click(function (e) {
            e.preventDefault();
            $("#otp_form .submitBTN").prop("disabled", !0).css({ "background": "#ccc", "color": "#fff", "cursor": "not-allowed" })
                            .html(`<svg width="20" height="20" viewBox="0 0 50 50" style="vertical-align:middle;margin-right:8px;" fill="#fff"><circle cx="25" cy="25" r="20" stroke="#888" stroke-width="5" fill="none" stroke-linecap="round"><animateTransform attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="1s" repeatCount="indefinite"/></circle></svg>Verifying Otp...`);

            var t = "";
            (t += $("#codeBox1").val()),
                (t += $("#codeBox2").val()),
                (t += $("#codeBox3").val()),
                (t += $("#codeBox4").val()),
                (t += $("#codeBox5").val()),
                (t += $("#codeBox6").val()),
                console.log("Entered OTP: " + t),
                console.log("otpUrl: " + otpUrl),
                $.ajax({
                    url: otpUrl,
                    type: "GET",
                    data: { otp: t },
                    success: function (e) {
                        $(".errormsg").hide();
                        // document.getElementById('msg-for-otp-send').style.display = 'none';
                        if (e.errors) {
                            $("#otp_form .submitBTN").html('Submit').removeAttr('style');
                            // $(".errormsg").html(e.errors.otp).show();
                            document.getElementById('msg-for-otp-send').innerHTML= e.errors.otp;
                            document.getElementById('msg-for-otp-send').style.display = 'block';
                            document.getElementById('msg-for-otp-send').style.color = 'red';
                            // document.getElementById('msg-for-otp-send').style.display = 'none';
                        } else {
                            // Redirect to previous URL if available, else to home
                            if (document.referrer && document.referrer !== window.location.href) {
                                window.location.href = document.referrer;
                            } else {
                                window.location.href = "/";
                            }
                        }
                    },
                    error: function (s) {
                        $("#otp_form .submitBTN").html('Submit').removeAttr('style');
                        var e = s.responseJSON.errors;
                        if (e && e.otp) {
                            document.getElementById('msg-for-otp-send').innerHTML = e.otp;
                            document.getElementById('msg-for-otp-send').style.display = 'block';
                            document.getElementById('msg-for-otp-send').style.color = 'red';
                        } else {
                            document.getElementById('msg-for-otp-send').innerHTML = "An error occurred. Please try again.";
                            document.getElementById('msg-for-otp-send').style.display = 'block';
                            document.getElementById('msg-for-otp-send').style.color = 'red';
                        }
                    },
                });
        }),
        $(".LoginPopInner .title1 p a").click(function () {
            $(".optForm").hide(), $(".mobForm").show(), clearInterval(s);
        });
    var r = $(".tabPadd a.active").width();
    $(".progressBar2 div").css("width", r + "px"),
        $(".tabPadd a").click(function () {
            $(this).parent().siblings().children("a").removeClass("active"), $(this).addClass("active");
            var s = $(this).width();
            $(this)
                .parents(".tabSec")
                .find(".progressBar2 div")
                .css("width", s + "px");
            var e = 0,
                t = $(this).parent().prevAll().length;
            for (i = 0; i < t; i++) e += parseInt($(this).parent().siblings().eq(i).outerWidth());
            $(this)
                .parents(".tabSec")
                .find(".progressBar2 div")
                .css("left", e + "px"),
                console.log(e);
        }),
        $(".faq_box a").click(function (s) {
            s.stopImmediatePropagation(s),
                $(this).siblings(".faq_box_text").slideToggle(200),
                $(this).parent().siblings().find(".faq_box_text").slideUp(200),
                $(this).parent().toggleClass("active"),
                $(this).parent().siblings().removeClass("active"),
                $(".faq_box a img").prop("src", faqIcons.plus),
                $(this).parent().hasClass("active") && $(this).children("img").prop("src", faqIcons.minus);
        }),
        $('.radioBtns1 .radioLable input[type="radio"]').change(function () {
            $(".proceedBtn button").prop("disabled", !1), $(".addressNote").show(), "Rent_Now" == $(this).val() ? $(".tenurePart").slideDown(200) : $(".tenurePart").hide();
        }),
        $(".offerLink1 a").click(function () {
            $(".offerPop").show();
        }),
        $(".offerPopInner > a").click(function () {
            $(".offerPop").hide();
        }),
        $(".flatDicountPopInner > a").click(function () {
            $(".flatDicountPop").hide();
        }),
        $(".removeDiscount a").click(function () {
            $(this).parent().hide(), $(this).parent().siblings(".linkPart").show();
        }),
        $(".addAddress button").click(function () {
            $(".addressFormPop1").show();
        }),
        $(".js-addadresspopup").click(function () {
            $(".addressFormPop").show();
        }),
        $(".addressFormPopInner > a").click(function () {
            $(".addressFormPop").hide(), $(".addressFormPop1").hide();
        }),
        $(".proceedBtn button").click(function () {
            "none" == $(".deliveryAddress").css("display") && ($(".addressNote").hide(), $(".addressNoteError").show());
        }),
        $(".welcomelabel a").click(function () {
            $(".welcomelabel").hide();
        }),
        $(".orderplacedPopInner > a").click(function () {
            $(".orderplacedPop").hide();
        }),
        $(".paymentFailedInner > a").click(function () {
            $(".paymentFailedPop").hide();
        }),
        $(".loginBtn button").click(function (s) {
            $(".LoginPop").show();
        }),
        $(".LoginPopInner > a").click(function () {
            document.querySelector(".LoginPop1").style.display = "none";
            $(".LoginPop").hide(), $(".optForm").hide(), $(".registerFormPart").hide(), $(".mobForm").show(), clearInterval(s);
        }),
        $(".a_otpPart .a_resendOtp a").click(function () {
            $(".a_resendOtp").hide(), $(".a_countText").show();
            var e,
                t = "otp_form";
            (e = "1:00"),
                (s = setInterval(function () {
                    var o = e.split(":"),
                        r = parseInt(o[0], 10),
                        n = parseInt(o[1], 10);
                    (r = --n < 0 ? --r : r),
                        (n = (n = n < 0 ? 59 : n) < 10 ? "0" + n : n),
                        $("#" + t + " .a_otpPart .a_countText p i").html("0" + r + ":" + n),
                        r < 0 && clearInterval(s),
                        n <= 0 && r <= 0 && clearInterval(s),
                        (e = r + ":" + n),
                        n <= 0 && r <= 0 && ($("#" + t + " .a_otpPart .a_countText").hide(), $("#" + t + " .a_otpPart .a_resendOtp").show());
                }, 1e3));
        }),
        $(".LoginPopInner .mobForm > p a").click(function () {
            document.querySelector(".LoginPop").style.display = "none";
            document.querySelector(".LoginPop1").style.display = "flex";
            $(".optForm").hide(), $(".mobForm").hide(), $(".registerFormPart").show(), clearInterval(s);
        }),
        $(".LoginPopInner .registerFormPart > p a").click(function () {
            $(".registerFormPart").hide(), $(".mobForm").show();
        }),
        $(".profileTag_name .profileDetails a").click(function () {
            $(".updateprofilePop").show();
        }),
        $(".updateprofilePopInner > a").click(function () {
            $(".updateprofilePop").hide();
        }),
        $(".cancel_share a.cancel_click").click(function () {
            $(".areyousurePop").css("display", "flex");
        }),
        $(".more_details a").click(function () {
            $(this).hasClass("active")
                ? ($(this).find("p").text("More Details"), $(".moredetail_product").hide(), $(this).removeClass("active"))
                : ($(this).find("p").text("Less Details"), $(".moredetail_product").show(), $(this).addClass("active"));
        }),
        $(".areyousureBlock > a").click(function () {
            $(".areyousurePop").hide();
        }),
        $("div.profileAccorClick").click(function (s) {
            s.stopImmediatePropagation(),
                $(this).toggleClass("active"),
                $(this).parent().siblings().children("div.profileAccorClick").removeClass("active"),
                $(this).parent().siblings().children(".profileAccorAns").slideUp(200),
                $(this).siblings().slideToggle(200);
        }),
        $(".acco_click a").click(function (s) {
            s.stopImmediatePropagation(), $(this).parent().siblings(".acco_text").slideToggle(200), $(this).toggleClass("inActive");
        });
});