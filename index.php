<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gold-Kings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <h4 class="text-center">Contact Form</h4>
    <div class="container" style="width:400px;">
        <div class="form_success"></div>
        <form id="contactus_form" action="javascript:alert(grecaptcha.getResponse(examcaptcha1));" enctype="multipart/form-data">
            <div class="mb-3 form-group">
                <label for="name" class="form-label">First Name</label>
                <input type="hidden" id="type" name="type" value="Contact I Mail">
                <input type="text" class="form-control" id="name" name="name" required data-error="Enter a Name">
                <div class="help-block with-errors text-danger"></div>
            </div>
            <div class="mb-3 form-group">
                <label for="phone" class="form-label">Phone No</label>
                <input type="text" class="form-control" id="phone" name="phone" minlength="10" maxlength="10" required
                    data-error="Enter a Phone No">
                <div class="help-block with-errors text-danger"></div>
                <div id="contact_num_validate" class="text-danger"></div>
            </div>
            <div class="mb-3 form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required data-error="Enter a Email">
                <div class="help-block with-errors text-danger"></div>
                <span class="text-danger email_error"></span>
            </div>
            <div class="mb-3 form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required
                    data-error="Enter a Subject">
                <div class="help-block with-errors text-danger"></div>
            </div>
            <div class="mb-3 form-group">
                <label for="message" class="form-label">Message</label>
                <input type="text" class="form-control" id="message" name="message" required
                    data-error="Enter a Message">
                <div class="help-block with-errors text-danger"></div>
            </div>
            <div class="mb-3 form-group">
                <label for="file" class="form-label">File Upload</label>
                <input type="file" name="fileToUpload" id="fileToUpload" onchange="return ImageValidate()" class="form-control"
                 required data-error="Choose a File">
                <div class="help-block with-errors text-danger"></div>
                <span id="img_validation" class="text-danger"></span>
            </div>
            <div id="captcha-1"></div>
            <span class="text-danger captcha_error"></span><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/form_validator.min.js"></script>
    <script src="assets/js/contact_form.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>

        var examcaptcha1;
        var onloadCallback = function () {
            examcaptcha1 = grecaptcha.render('captcha-1', {
                'sitekey': '6Lc93s0mAAAAAAeafnYeYGhLPbndbR56C8pVJkxf',
                'theme': 'light'
            });
        }

    </script>


    <script>
        function ImageValidate(){
            var fileName = document.getElementById("fileToUpload").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var ext = fileName.substr(idxDot, fileName.length).toLowerCase();

            if (((ext == "pdf") ||(ext == "jpg") || (ext == "jpeg") || (ext == "png"))) {
                document.getElementById('img_validation').innerHTML="";
                return true;
            }
            else{
                document.getElementById('img_validation').innerHTML="Must be files Type";
                return;
            }

        }
    </script>

</body>

</html>