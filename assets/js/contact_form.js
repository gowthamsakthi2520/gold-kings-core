/*==============================================================*/
// Raque Contact Form  JS
/*==============================================================*/

(function ($) {

    "use strict"; // Start of use strict
    $("#contactus_form").validator().on("submit", function (event) {

        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();

            // submitMSG(false, "Did you fill in the form properly?");
        } else {
            // everything looks good!

            event.preventDefault();
            submitForm();
        }
    });

    //email function check
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }

    function submitForm() {

        $('.email_error').html('');
        $('.captcha_error').html('');
        document.getElementById('contact_num_validate').innerHTML = "";
        var phone = $('#phone').val();
        var email = $('#email').val();
        var name = $('#name').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        var type = $('#type').val();
        var file_data = $('#fileToUpload').prop('files')[0];
        var check_email = isValidEmailAddress(email);
        // var check_image = ImageValidate(file_data);
        var captcha_valid = grecaptcha.getResponse(examcaptcha1);

        // var form = $('#contactus_form')[0];

        const form_data = new FormData();
        form_data.append('type', type);
        form_data.append('file', file_data);
        form_data.append('name', name);
        form_data.append('phone', phone);
        form_data.append('email', email);
        form_data.append('subject', subject);
        form_data.append('message', message);
        form_data.append('captcha_valid', captcha_valid);
        if (phone.length == 10) {

            if (check_email == true) {
                if (captcha_valid === "") {

                    $('.captcha_error').html('Please Fill Captcha');
                } else {

                    $("#preloder").fadeIn();
                    $.ajax({
                        type: "POST",
                        url: "mail.php",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        success: function (text) {
        
        
                            if (text == "success") {
                                $("#preloder").fadeOut();
                                console.log(text);
                                $('.captcha_error').html('');
                                $('#contactus_form')[0].reset();
                                $('.form_success').html('<div  class="alert alert-success" role="alert">Form Submitted Successfully!</div>');
        
                                setTimeout(() => {
                                    // window.location.reload();
                                    grecaptcha.reset();
                                    $('.form_success').html('');
                                }, 2000)
        
                            } else {
                                $("#preloder").fadeOut();
                                // $('.email_error').html('Email Address Invalid');
                            }
        
        
        
                        }
                    });
        

                }


            } else {
                $('.email_error').html('Email Address Invalid');
            }
        } else {
            document.getElementById('contact_num_validate').innerHTML = "Phone No Must be 10 Digits Only";
        }


    }

    function formSuccess() {
        $("#contactus_form")[0].reset();
        submitMSG(true, "Message Submitted!")
    }

    function formError() {

        $("#contactus_form").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();

        });

    }



    function submitMSG(valid, msg) {
        if (valid) {
            var msgClasses = "h4 tada animated text-success";
        } else {
            var msgClasses = "h4 text-danger";
        }
    }
}(jQuery)); // End of use strict




// name validation

$(document).on('keypress', '#name', function (event) {
    var regex = new RegExp("^[a-zA-Z ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});



// number validate function

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        e.preventDefault();
        return false;
    }

}

$(document).on("input", "#phone", function () {
    this.value = this.value.replace(/\D/g, '');
});


// image mimi type validation


    // $("#fileToUpload").on("change",function() {

    //     var $input = $(this);

    //     var files = $input[0].files;

    //     var filename = files[0].name;


    //     var extension = filename.substr(filename.lastIndexOf("."));

    //     var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png|\.gif)$/i;


    //     var isAllowed = allowedExtensionsRegx.test(extension);

    //     if(allowedExtensionsRegx.test(extension)){
    //         document.getElementById('img_validation').innerHTML = "Must be Application Types";
    //        return;
    //     } else {
    //         alert("Image Uploaded.");
    //     }
    // });
