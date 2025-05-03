$(document).ready(function(){
    
    
    
    if($('.otp-wrap').length > 0){


        var BACKSPACE_KEY = 8;
        var ENTER_KEY = 13;
        var TAB_KEY = 9;
        var LEFT_KEY = 37;
        var RIGHT_KEY = 39;
        var ZERO_KEY = 48;
        var NINE_KEY = 57;

        function otp(elementId) {
            var inputs = document.getElementById(elementId).children;
            var callback = null;

            function init(completeCallback) {
                callback = completeCallback;
                for (i = 0; i < inputs.length; i++) {
                    registerEvents(i, inputs[i]);
                }
            }

            function destroy() {
                for (i = 0; i < inputs.length; i++) {
                    registerEvents(i, inputs[i]);
                }
            }

            function registerEvents(index, element) {
                element.addEventListener("input", function (ev) {
                    onInput(index, ev);
                });
                element.addEventListener("paste", function (ev) {
                    onPaste(index, ev);
                });
                element.addEventListener("keydown", function (ev) {
                    onKeyDown(index, ev);
                });
            }

            function onPaste(index, ev) {
                ev.preventDefault();
                var curIndex = index;
                var clipboardData = ev.clipboardData || window.clipboardData;
                var pastedData = clipboardData.getData("Text");
                for (i = 0; i < pastedData.length; i++) {
                    if (i < inputs.length) {
                        if (!isDigit(pastedData[i])) break;
                        inputs[curIndex].value = pastedData[i];
                        curIndex++;
                    }
                }
                if (curIndex == inputs.length) {
                    inputs[curIndex - 1].focus();
                    callback(retrieveOTP());
                } else {
                    inputs[curIndex].focus();
                }
            }

            function onKeyDown(index, ev) {
                
                
                if(index == 5){
                    $('#otp-inputs input').siblings('.errormsg').hide();
                }
                if(index == 5){
                    setTimeout(function(){
                        //$('#otp-inputs input').blur();
                        $('#otp_form .submitBTN').trigger('click');
                    },200);
                }
                var key = ev.keyCode || ev.which;
                if (key == LEFT_KEY && index > 0) {
                    ev.preventDefault(); // prevent cursor to move before digit in input
                    inputs[index - 1].focus();
                }
                if (key == RIGHT_KEY && index + 1 < inputs.length) {
                    ev.preventDefault();
                    inputs[index + 1].focus();
                    
                }
                if (key == BACKSPACE_KEY && index > 0) {
                    if (inputs[index].value == "") {
                        // Empty and focus previous input and current input is empty
                        inputs[index - 1].value = "";
                        inputs[index - 1].focus();
                    } else {
                        inputs[index].value = "";
                    }
                }
                if (key == ENTER_KEY) {
                    // force submit if enter is pressed
                    ev.preventDefault();
                    if (isOTPComplete()) {
                        callback(retrieveOTP());
                    }
                }
                if (key == TAB_KEY && index == inputs.length - 1) {
                    // force submit if tab pressed on last input
                    ev.preventDefault();
                    if (isOTPComplete()) {
                        callback(retrieveOTP());
                    }
                }
            }

            function onInput(index, ev) {
                var value = ev.data || ev.target.value;
                var curIndex = index;
                for (i = 0; i < value.length; i++) {
                    if (i < inputs.length) {
                        if (!isDigit(value[i])) {
                            inputs[curIndex].value = "";
                            break;
                        }
                        inputs[curIndex++].value = value[i];
                        if (curIndex == inputs.length) {
                            if (isOTPComplete()) {
                                callback(retrieveOTP());
                            }
                        } else {
                            inputs[curIndex].focus();
                        }
                    }
                }
            }
            
            function retrieveOTP() {
                var otp = "";
                for (i = 0; i < inputs.length; i++) {
                    otp += inputs[i].value;
                }
                return otp;
            }

            function isDigit(d) {
                return d >= "0" && d <= "9";
            }

            function isOTPComplete() {
                var isComplete = true;
                var i = 0;
                while (i < inputs.length && isComplete) {
                    if (inputs[i].value == "") {
                        isComplete = false;
                    }
                    i++;
                }
                return isComplete;
            }

            return {
                init: init
            };
        }

        var otpModule = otp("otp-inputs");
        otpModule.init(function (passcode) {

            $('#otp-inputs input').blur();
        });
     

    

        }
    
    
    $('.bannerSlider').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: true,
                arrows: false,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
                arrows: false,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false,
            }
          }
        ]
    });


    $('.offer_slider').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 2.59,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2.2,
              slidesToScroll: 1,
              dots: true,
                arrows: false,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1.1,
              slidesToScroll: 1,
                arrows: false,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1.1,
              slidesToScroll: 1, 
                arrows: false,
            }
          }
        ]
    });

    $('.product_slider').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 3.95,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2.5,
              slidesToScroll: 1, 
              dots: true,
                arrows: false,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1.2,
              slidesToScroll: 1,
                arrows: false,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1.2,
              slidesToScroll: 1, 
                arrows: false,
            }
          }
        ]
    });
    
    $('.product_slider2').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2.5,
              slidesToScroll: 1, 
              dots: true,
                arrows: false,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1.2,
              slidesToScroll: 1,
                arrows: false,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2.6,
              slidesToScroll: 1, 
                arrows: false,
            }
          }
        ]
    });
    
    
    $('.customerSlider').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 2.65,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2.2,
              slidesToScroll: 1, 
              dots: true,
                arrows: false,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1.2,
              slidesToScroll: 1,
                arrows: false,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1.2,
              slidesToScroll: 1, 
                arrows: false,
            }
          }
        ]
    });
    $('.catgory_slider').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 2.65,
        slidesToScroll: 1,
        variableWidth: true, // Add this
        width:12.5,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2.2,
                    slidesToScroll: 1,
                    dots: false,
                    arrows: false,
                    
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1.2,
                    slidesToScroll: 1,
                    arrows: false,
                    
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1.2,
                    slidesToScroll: 1,
                    arrows: false,
                    
                }
            }
        ]
    });    
    $('.catgory_slider').on('setPosition', function () {
        $('.catgory_slider .slick-slide').css('width', '151px'); // Adjust width here
    });
    $('.slick-dots ').css('display', 'none');
    $('.slide_product').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              dots: true,
                arrows: false,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
                arrows: false,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
                arrows: false,
            }
          }
        ]
      });
      
    
    
    if($(window).width() < 769){
        $('.why_arogya_bharat_all_box').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows:false
        });
    }
 

    $('.progressBar').html('<div></div>')

    function getProWidth(){
        $('.getprogressWidth').each(function(){
            var bannerCount = $(this).find(".slick-dots li").length;
            var bannerL = 100 / bannerCount;
            $(this).siblings('.progressBar').find('div').css('width',bannerL+'%');
        });
    }
    function changeSlide(th){
        var bannerCount = th.find(".slick-dots li").length;
        var bannerL = 100 / bannerCount;
        var bannerIndex = th.find(".slick-active").index() + 1;
        console.log(bannerIndex);
        var progressWidth = bannerL * bannerIndex 
        th.siblings('.progressBar').find('div').css('width',progressWidth+ '%');
    }

    getProWidth();  
      
    $('.getprogressWidth').on("afterChange", function() {
        changeSlide($(this));
    });   





    $('.SearchBlock input').keyup(function(){
        if($(this).val().length > 0){
            $(this).siblings('a').show();
            $('.searchPop').fadeIn();
        }else{
            $(this).siblings('a').hide();
            $('.searchPop').hide();
        }
        if($(window).width() <= 768){
            if($(this).val().length > 0){ 
              $(this).parents('.SearchBlock').siblings('#customerlocationPin').find('.locationPin').hide();
              $(this).parents('.SearchBlock').css('width','90%');
                $(this).parents('.SearchBlock').children('a').show();
            }else{
              $(this).parents('.SearchBlock').siblings('#customerlocationPin').find('.locationPin').delay(10).fadeIn(10);
              $(this).parents('.SearchBlock').removeAttr('style');
                $(this).parents('.SearchBlock').children('a').hide();
            }
        } 
        
        if($('.winScrollStop').css('display') == 'none'){
            $('body').css('overflow-y','auto')
        }else{
            $('body').css('overflow-y','hidden')
        }
    });
 
    $('.searchPop').click(function(){
        $('.searchPop').hide();
    });
    
    
    $('.locationPin').click(function(){
        $('.locationPop').css('display','flex');
    });
    $('.locationBlock > a').click(function(){
        $('.locationPop').hide();
    });
	
	//  $('.notificationpopupjs').click(function(){
    //     $('.notificationPop').css('display','flex');
    // });
    // $('.notificationBlock > a').click(function(){
    //     $('.notificationPop').hide();
    // });
	
	
	
    $(window).click(function(){
        
        var ccc = 0;
        
        $('.winScrollStop').each(function(){
            if($(this).css('display') != 'none'){
                //$('body').css('overflow-y','auto')
                ccc++
            }else{
                //$('body').css('overflow-y','hidden')
            }
        });
        if(ccc > 0){
            $('body').css('overflow-y','hidden')
        }else{
            $('body').css('overflow-y','auto')
        } 
        
    });
    
    if($('.headerBlock').length > 1){
        var searchoffset = $('.SearchBlock').offset().left;
        if($(window).width() > 768){
            $('.searchPopBlock').css('margin-left',searchoffset+'px');
        }
    }
    
    $('.SearchBlock > a').click(function(){
        $(this).siblings('div').children('input').val('');
        $(this).siblings('div').children('a').hide();
        $('.searchPop').hide();
        $('.locationPin').delay(500).fadeIn();
        $('.SearchBlock').removeAttr('style');
        $(this).hide();
    });
    
    
    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.uploadeedImg').attr('src', e.target.result);
                $('.fileUpload').hide();
                $('.uploadedPart').css('display','flex');
                $('.uploadedPart').siblings('.errormsg').hide();
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $('.uploadedPart .imgDis a').click(function(){
        $('.file-upload').val('');
        $('.uploadedPart').hide();
        $('.fileUpload').show();
    });
    
    
    
    
    
    
    
       function fildValidation(th, ErrMSG) {
        if (ErrMSG) {
            $(th).siblings(".errormsg").text(ErrMSG);
        }
    }
    
 function allFormFieldValidationCheck(ThisObj, eventType) {
     
        var parent = ThisObj.parents("form").attr("id");
        var error = 0;
        $("#" + parent + " " + ".inputMainBlock input,#" + parent + " " + ".inputMainBlock textarea").each(function () {

            if (!$(this).hasClass("nomandetory")) {
                if (!$(this).attr('disabled')) {
                    if ($(this).val() == "") { 
                            $(this).parents('.inputMainBlock').find('.errormsg').show();
                            fildValidation(this); 
                    } else {

                        if ($(this).hasClass('mobileVD')) {

                            var value = $(this).val();

                            if (value.length < 10 || value.length > 10) {

                                if (eventType == 1) {
                                    $(this).parents('.inputMainBlock').find('.errormsg').show();
                                    fildValidation(this, "Please enter a valid 10-digit mobile number");
                                }

                            } else {
                                if (value.indexOf('.') > -1) {
                                    $(this).parents('.inputMainBlock').find('.errormsg').show();
                                    fildValidation(this, "Please enter a valid 10-digit mobile number");
                                } else if (value.substr(0, 1) == 9 || value.substr(0, 1) == 8 || value.substr(0, 1) == 7 || value.substr(0, 1) == 6 || value.substr(0, 1) == 5) {
                                    $(this).parents('.inputMainBlock').find('.errormsg').hide();
                                    fildValidation(this);
                                } else {
                                    $(this).parents('.inputMainBlock').find('.errormsg').show();
                                    fildValidation(this, "Mobile number should start with 9 or 8 or 7 or 6 or 5");
                                }
                            }

                        }else if ($(this).hasClass('FullNameVD')) {
                        var sval = $(this).val().trim();
                            sval = sval.replace(/\s\s+/g, ' ');
                        $(this).val(sval);
                            
                        var checkequal = sval.split(" ");
                            
                        var [fname, mname, lname] = checkequal;
                            
                            
                        var fname_1 = "";
                        var fname_2 = "";
                            
                        var mname_1 = "";
                        var mname_2 = "";
                            
                        var lname_1 = "";
                        var lname_2 = "";
                             
                        if(fname){
                            fname_1 = fname.substr(0,1);
                            fname_2 = fname.substr(1,2);
                            fname = fname.toLowerCase();
                        }
  
                        if(mname){
                            mname_1 = mname.substr(0,1);
                            mname_2 = mname.substr(1,2);
                            mname = mname.toLowerCase();
                            
                        }
                         
                        if(lname){
                            lname_1 = lname.substr(0,1);
                            lname_2 = lname.substr(1,2);
                            lname = lname.toLowerCase();
                        }
                        
                            
                           
                        if (!/^[a-zA-Z .]*$/g.test($(this).val())) {
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "Only alphabets are allowed"); 
                            
                        }else if ($(this).val().split(" ").length == 1) {
                            $(this).siblings(".errormsg").show(); 
                            fildValidation(this, "Enter valid full name");
                        }else if(fname.length == 1 && mname.length == 1 && lname.length == 1){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "Enter valid full name"); 
                        }else if(fname.length == 2 && mname.length == 2 && lname.length == 2){
                            if(fname_1 == fname_2 && mname_1 == mname_2 && lname_1 == lname_2){
                                $(this).siblings(".errormsg").show();
                                fildValidation(this, "Enter valid full name"); 
                            }
                        }else if(fname == mname){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "First Name and Middle Name cannot be same"); 
                        }else if(fname == lname){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "First Name & Last Name cannot be same"); 
                        }else if(mname == lname){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "Middle Name and last name cannot be same"); 
                        }else {
                            if ($(this).val().split(" ").length > 3) {
                                $(this).siblings(".errormsg").show();
                                fildValidation(this, "More than 2 spaces are not allowed"); 
                            }else {
                                $(this).siblings(".errormsg").hide();
                                fildValidation(this); 
                            }

                        }
                    }else  if ($(this).hasClass('emailVD')) {
								var a = $(this).val();
								var filter = /^[A-Za-z0-9!#%&\'*+-/=?^_`{|}~]+@[A-Za-z0-9-]+(\.[AZa-z0-9-]+)+[A-Za-z]$/;
								if (filter.test(a)) {
										   $(this).siblings(".errormsg").hide();  
										  fildValidation(this,"VDtrue");
								}
								else {
									$(this).siblings(".errormsg").show();error++;
									 fildValidation(this,"Enter valid Email ID");
								}
							}else if ($(this).hasClass('AnyValueVD')) {

                            var value = $(this).val();

                            if (!value) {

                                $(this).parents('.inputMainBlock').find('.errormsg').show();
                                fildValidation(this); 

                            } else {

                                $(this).parents('.inputMainBlock').find('.errormsg').hide();
                                fildValidation(this); 

                            }
                            

                        }
                    }

                }
            }

        });
        
 
    
 }
               
    $(".submitBTN").click(function (e) {
        e.preventDefault();
        var ThisObj = $(this);
        var NoError = allFormFieldValidationCheck(ThisObj, 1);
    });
     
    
    $(".inputMainBlock input,.inputMainBlock textarea").blur(function () {
        var ThisObj = $(this);

        if (!$(this).hasClass("nomandetory")) {
            if (!$(this).attr('disabled')) { 
                if ($(this).val() == "") {
                        $(this).parents('.inputMainBlock').find('.errormsg').show();
                        fildValidation(this); 
                    
                } else {
                    if ($(this).hasClass('mobileVD')) { 
                            var value = $(this).val();

                            if (value.length < 10 || value.length > 10) {
                                    $(this).parents('.inputMainBlock').find('.errormsg').show();
                                    fildValidation(this, "Please enter a valid 10-digit mobile number");
                            } else {
                                if (value.indexOf('.') > -1) {
                                    $(this).parents('.inputMainBlock').find('.errormsg').show();
                                    fildValidation(this, "Please enter a valid 10-digit mobile number");
                                } else if (value.substr(0, 1) == 9 || value.substr(0, 1) == 8 || value.substr(0, 1) == 7 || value.substr(0, 1) == 6 || value.substr(0, 1) == 5) {
                                    $(this).parents('.inputMainBlock').find('.errormsg').hide();
                                    fildValidation(this);
                                } else {
                                    $(this).parents('.inputMainBlock').find('.errormsg').show();
                                    fildValidation(this, "Mobile number should start with 9 or 8 or 7 or 6 or 5");
                                }
                            } 

                        }else if ($(this).hasClass('FullNameVD')) {
                        var sval = $(this).val().trim();
                            sval = sval.replace(/\s\s+/g, ' ');
                        $(this).val(sval);
                            
                        var checkequal = sval.split(" ");
                            
                        var [fname, mname, lname] = checkequal;
                            
                            
                        var fname_1 = "";
                        var fname_2 = "";
                            
                        var mname_1 = "";
                        var mname_2 = "";
                            
                        var lname_1 = "";
                        var lname_2 = "";
                             
                        if(fname){
                            fname_1 = fname.substr(0,1);
                            fname_2 = fname.substr(1,2);
                            fname = fname.toLowerCase();
                        }
  
                        if(mname){
                            mname_1 = mname.substr(0,1);
                            mname_2 = mname.substr(1,2);
                            mname = mname.toLowerCase();
                            
                        }
                         
                        if(lname){
                            lname_1 = lname.substr(0,1);
                            lname_2 = lname.substr(1,2);
                            lname = lname.toLowerCase();
                        }
                        
                            
                           
                        if (!/^[a-zA-Z .]*$/g.test($(this).val())) {
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "Only alphabets are allowed"); 
                            
                        }else if ($(this).val().split(" ").length == 1) {
                            $(this).siblings(".errormsg").show(); 
                            fildValidation(this, "Enter valid full name");
                        }else if(fname.length == 1 && mname.length == 1 && lname.length == 1){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "Enter valid full name"); 
                        }else if(fname.length == 2 && mname.length == 2 && lname.length == 2){
                            if(fname_1 == fname_2 && mname_1 == mname_2 && lname_1 == lname_2){
                                $(this).siblings(".errormsg").show();
                                fildValidation(this, "Enter valid full name"); 
                            }
                        }else if(fname == mname){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "First Name and Middle Name cannot be same"); 
                        }else if(fname == lname){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "First Name & Last Name cannot be same"); 
                        }else if(mname == lname){
                            $(this).siblings(".errormsg").show();
                            fildValidation(this, "Middle Name and last name cannot be same"); 
                        }else {
                            if ($(this).val().split(" ").length > 3) {
                                $(this).siblings(".errormsg").show();
                                fildValidation(this, "More than 2 spaces are not allowed"); 
                            }else {
                                $(this).siblings(".errormsg").hide();
                                fildValidation(this); 
                            }

                        }
                    }else  if ($(this).hasClass('emailVD')) {
								var a = $(this).val();
								var filter = /^[A-Za-z0-9!#%&\'*+-/=?^_`{|}~]+@[A-Za-z0-9-]+(\.[AZa-z0-9-]+)+[A-Za-z]$/;
								if (filter.test(a)) {
										   $(this).siblings(".errormsg").hide();  
										  fildValidation(this,"VDtrue");
								}
								else {
									$(this).siblings(".errormsg").show();error++;
									 fildValidation(this,"Enter valid Email ID");
								}
							}else if ($(this).hasClass('AnyValueVD')) {

                            var value = $(this).val();

                            if (!value) {
                                $(this).parents('.inputMainBlock').find('.errormsg').show();
                                fildValidation(this);
                            } else {
                                $(this).parents('.inputMainBlock').find('.errormsg').hide();
                                fildValidation(this);
                            }

                        }
                     
                }

            } 
            } 



    });
     

 


    $('.mobileVD').keyup(function (e) {
        var mo = $(this).val();
        if (mo.length > 10) {
        $(this).val(mo.substr(0, 10));
        }

    });
     
 
    
    $('body').on('keydown', '.mobileVD', function() {
      k = event.which; 
        var mo = $(this).val();
        mo = mo.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
        $(this).val(mo);
        
        
      if ((k >= 48 && k <= 57) || (k >= 96 && k <= 105) || k == 8 || k == 9) {
        if ($(this).val().length == 10) {
          if (k == 8 || k == 9) {
            return true;
          } else {
            event.preventDefault();
            return false;

          }
        }
      } else {
        event.preventDefault();
        return false;
      }

    });
    
 
    
    
    
    
    

   
    function validornot(th) {
        if ($(th).attr("name") === "pincode") {
            return; // Skip validation for pincode
        }
    
        if (!$(th).hasClass("nomandetory")) {
            if ($(th).siblings(".errormsg").css("display") == "none") { 
                $(th).parents('.inputMainBlock').addClass("valid").removeClass("invalid");
            } else {
                $(th).parents('.inputMainBlock').removeClass("valid").addClass("invalid"); 
            }
        }
    }
    
    
    $(".inputMainBlock input").blur(function(){
        validornot(this);
    });
 
    
    
    // $("#raise_form .submitBTN").click(function (e) {
    //     setTimeout(function () {
    //           var totalerror = 0;
    //             $("#raise_form .errormsg").each(function (i) {
    //                 if ($(this).css("display") == "block") {
    //                     totalerror++;
    //                 }
    //             });
    //             if (totalerror == 0) {
    //                 alert('Form fill successfully')
    //             }
    //     }, 500);
    // });
    
    // $("#addressForm .submitBTN").click(function (e) {
    //     // setTimeout(function () {
    //     //       var totalerror = 0;
    //     //         $("#addressForm .errormsg").each(function (i) {
    //     //             if ($(this).css("display") == "block") {
    //     //                 totalerror++;
    //     //             }
    //     //         });
    //     //         if (totalerror == 0) {
    //     //             $('.addressFormPop').hide();
    //     //             $('.addAddress').hide();
    //     //             $('.deliveryAddress').show();
    //     //             $('body').css('overflow-y','auto');
    //     //         }
    //     // }, 500);
    // });
    
    
    // $("#loginMo .submitBTN").click(function (e) {
    //     setTimeout(function () {
    //           var totalerror = 0;
    //             $("#loginMo .errormsg").each(function (i) {
    //                 if ($(this).css("display") == "block") {
    //                     totalerror++;
    //                 }
    //             });
    //             if (totalerror == 0) {
    //                 $('.mobForm').hide();
    //                 $('.optForm').show();
    //                 count3minut('otp_form');
    //             }
    //     }, 500);
    // });
    
    $("#otp_form .submitBTN").click(function (e) {
        e.preventDefault(); // Prevent default form submission
        var otpCode = '';
        otpCode += $('#codeBox1').val();
        otpCode += $('#codeBox2').val();
        otpCode += $('#codeBox3').val();
        otpCode += $('#codeBox4').val();
        otpCode += $('#codeBox5').val();
        otpCode += $('#codeBox6').val();
    
        console.log('Entered OTP: ' + otpCode); // Debug log for OTP
        console.log('otpUrl: ' + otpUrl); // Debug log for OTP URL
    
        $.ajax({
            url: otpUrl,
            type: 'GET',
            data: {
                otp: otpCode,
            },
            success: function (response) {
                $('.errormsg').hide(); // Hide any previous error messages
                if (response.errors) {
                    $('.errormsg').html(response.errors.otp).show();
                } else {
                      location.reload();
                    $('.optForm').hide();
                    $('.mobForm').show();
                    clearInterval(interval);
                    $('.LoginPop').hide();
                    $('body').css('overflow-y', 'auto');
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors && errors.otp) {
                    $('.errormsg').html(errors.otp).show();
                } else {
                    $('.errormsg').html('An error occurred. Please try again.').show();
                }
            }
        });
    });
    
    
    $('.LoginPopInner .title1 p a').click(function(){
        $('.optForm').hide();
        $('.mobForm').show();
        clearInterval(interval);
    });
    
    // $("#register_form .submitBTN").click(function (e) {
    //     setTimeout(function () {
    //           var totalerror = 0;
    //             $("#register_form .errormsg").each(function (i) {
    //                 if ($(this).css("display") == "block") {
    //                     totalerror++;
    //                 }
    //             });
    //             if (totalerror == 0) {
    //                 $('.registerFormPart').hide();
    //                 $('.LoginPop').hide();
    //                 $('.mobForm').show(); 
    //                 $('body').css('overflow-y','auto');
    //             }
    //     }, 500);
    // });

    // $("#register_form .submitBTN").click(function (e) {
    //     e.preventDefault();
    //     var formData = $('#register_form').serialize();
    //     $.ajax({
    //         url: '{{ route('customers.store') }}',
    //         type: 'POST',
    //         data: formData,
    //         success: function (response) {
    //             $('.errormsg').html('');
    //             if (response.errors) {
    //                 $.each(response.errors, function (key, value) {
    //                     $('input[name="' + key + '"]').next('.errormsg').html(value[0]).css("display", "block");
    //                 });
    //             } else {
    //                 alert(response.success);
    //                 $('#register_form')[0].reset();
    //                 $('.registerFormPart').hide();
    //                 $('.LoginPop').hide();
    //                 $('.mobForm').show();
    //                 $('body').css('overflow-y', 'auto');
    //             }
    //         },
    //         error: function (xhr) {
    //             $('.errormsg').html('');
    //             $.each(xhr.responseJSON.errors, function (key, value) {
    //                 $('input[name="' + key + '"]').next('.errormsg').html(value[0]).css("display", "block");
    //             });
    //         }
    //     });
    // });
// });

    
    // $("#updatepro .submitBTN").click(function (e) {
    //     setTimeout(function () {
    //           var totalerror = 0;
    //             $("#updatepro .errormsg").each(function (i) {
    //                 if ($(this).css("display") == "block") {
    //                     totalerror++;
    //                 }
    //             });
    //             if (totalerror == 0) {
    //                 $('.updateprofilePop').hide();
    //                 $('body').css('overflow-y','auto');
    //             }
    //     }, 500);
    // });
    
    
    
    
    
        // otp counter
        var interval;
    function count3minut(otpFid) {
        var timer2 = "1:00";
        interval = setInterval(function() {
            var timer = timer2.split(':');
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            alert(otpFid);
            alert(minutes);
            alert(seconds);
            $('#'+otpFid+' .a_otpPart .a_countText p i').html('0' + minutes + ':' + seconds);
            if (minutes < 0) clearInterval(interval);
            if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
            timer2 = minutes + ':' + seconds;

            if ((seconds <= 0) && (minutes <= 0)) {
                $('#'+otpFid+' .a_otpPart .a_countText').hide();
                $('#'+otpFid+' .a_otpPart .a_resendOtp').show();
            }

        }, 1000);
        
    }
    
    
    
    
    var activeWidth = $('.tabPadd a.active').width();
    $('.progressBar2 div').css('width',activeWidth+'px');
    $('.tabPadd a').click(function(){
        
        $(this).parent().siblings().children('a').removeClass('active');
        $(this).addClass('active');
        
        var tabwidth = $(this).width();
        $(this).parents('.tabSec').find('.progressBar2 div').css('width',tabwidth+'px');
 
        
        var widthAdd = 0;
        var lengthPreDiv = $(this).parent().prevAll().length;
        for(i=0; i<lengthPreDiv; i++){
            widthAdd = widthAdd+parseInt($(this).parent().siblings().eq(i).outerWidth());
        }
        $(this).parents('.tabSec').find('.progressBar2 div').css('left',widthAdd+'px');
        console.log(widthAdd);
    });

    
    $('.faq_box a').click(function(e){
        e.stopImmediatePropagation(e);
        $(this).siblings('.faq_box_text').slideToggle(200);
        $(this).parent().siblings().find('.faq_box_text').slideUp(200);
        
        $(this).parent().toggleClass('active');
        $(this).parent().siblings().removeClass('active');
        $('.faq_box a img').prop('src',faqIcons.plus);
        if($(this).parent().hasClass('active')){
            $(this).children('img').prop('src',faqIcons.minus);
        }
        
    });
    
    
    // $('.countMinus').on('click', function () {
    //     var count = $(this).siblings('span').text();
    //     if(count > 1){
    //         $(this).siblings('span').text(Number(count) - 1);
    //     }
    // });
    // $('.countPlus').on('click', function () {
    //     var count = $(this).siblings('span').text();
    //     $(this).siblings('span').text(Number(count) + 1);
    // });
    
    $('.radioBtns1 .radioLable input[type="radio"]').change(function(){
        $('.proceedBtn button').prop('disabled',false);
        $('.addressNote').show();
        if($(this).val() == 'Rent_Now'){
            $('.tenurePart').slideDown(200);
        }else{
            $('.tenurePart').hide();
        }
    });
    
    $('.offerLink1 a').click(function(){
        $('.offerPop').show();
    });
    
    $('.offerPopInner > a').click(function(){
        $('.offerPop').hide();
    });
    
    
    // $('.flatOffer .linkPart a').click(function(){
    //     $('.flatDicountPop').css('display','flex');
    //     $(this).parent().hide();
    //     $(this).parent().siblings('.removeDiscount').show();
    // });
    
    $('.flatDicountPopInner > a').click(function(){
        $('.flatDicountPop').hide();
    });
    
    $('.removeDiscount a').click(function(){
        $(this).parent().hide();
        $(this).parent().siblings('.linkPart').show();
    });
    
    $('.addAddress button').click(function(){
        $('.addressFormPop1').show();
    });
	  $('.js-addadresspopup').click(function(){
        $('.addressFormPop').show();
    });
    $('.addressFormPopInner > a').click(function(){
        $('.addressFormPop').hide();
        $('.addressFormPop1').hide();
    });
    
    $('.proceedBtn button').click(function(){
        if($('.deliveryAddress').css('display') == 'none'){
            $('.addressNote').hide();
            $('.addressNoteError').show();
        }
    });
    
    $('.welcomelabel a').click(function(){
        $('.welcomelabel').hide();
    });
    
    $('.orderplacedPopInner > a').click(function(){
        $('.orderplacedPop').hide();
    });
    
    $('.paymentFailedInner > a').click(function(){
        $('.paymentFailedPop').hide();
    }); 
    
    $('.loginBtn button').click(function(e){
        e.preventDefault();
        $('.LoginPop').show();
        //$('body').css('overflow-y','hidden'); 
    });
    
    $('.LoginPopInner > a').click(function(){
        $('.LoginPop').hide();
        $('.optForm').hide();
        $('.registerFormPart').hide();
        $('.mobForm').show();
        clearInterval(interval);
    });
    
    $('.a_otpPart .a_resendOtp a').click(function(){
        $('.a_resendOtp').hide();
        $('.a_countText').show();
        count3minut('otp_form');
    });
    
    $('.LoginPopInner .mobForm > p a').click(function(){
        $('.mobForm').hide();
        $('.registerFormPart').show();
    });
    
    $('.LoginPopInner .registerFormPart > p a').click(function(){
        $('.registerFormPart').hide();
        $('.mobForm').show();
    });
    
    $('.profileTag_name .profileDetails a').click(function(){
        $('.updateprofilePop').show();
    });
    $('.updateprofilePopInner > a').click(function(){
        $('.updateprofilePop').hide();
    });

    $('.cancel_share a.cancel_click').click(function(){
        $('.areyousurePop').css('display','flex');
    });
	
	$('.more_details a').click(function(){
		if(!$(this).hasClass('active')){
		   $(this).find('p').text('Less Details');
		   $('.moredetail_product').show();
		   $(this).addClass('active');
		}else{
			  $(this).find('p').text('More Details');
		   $('.moredetail_product').hide();
		    $(this).removeClass('active');
		}
    });
	
	
	
	
    $('.areyousureBlock > a').click(function(){
        $('.areyousurePop').hide();
    });
    $('div.profileAccorClick').click(function(e){
        e.stopImmediatePropagation();

        $(this).toggleClass('active');
        $(this).parent().siblings().children('div.profileAccorClick').removeClass('active');
        $(this).parent().siblings().children('.profileAccorAns').slideUp(200);
        $(this).siblings().slideToggle(200);
    });
    
    $('.acco_click a').click(function(e){
        e.stopImmediatePropagation();
        $(this).parent().siblings('.acco_text').slideToggle(200);
        $(this).toggleClass('inActive')
    });
 
});


function getCodeBoxElement(index) {
    return document.getElementById('codeBox' + index);
}
function onFocusEvent(index) {
    for (item = 1; item < index; item++) {
        const currentElement = getCodeBoxElement(item);
        if (!currentElement.value) {
            currentElement.focus();
            break;
        }
    }
}   