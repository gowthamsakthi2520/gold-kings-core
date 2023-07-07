<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

session_start();


//file uploads

if($_FILES['file']['name'] != ''){

    $test = explode('.', $_FILES['file']['name']);
    $extension = end($test);    
    $name = rand(100,999).'.'.$extension;

    $location = 'uploads/'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);

    // echo '<img src="'.$location.'" height="100" width="100" />';
}


if (!empty($_POST['name']) != "") {

    $type = $_POST['type'];
    $mail = new PHPMailer(true);
    //Enable SMTP debugging.
    $mail->SMTPDebug = 2;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name                          
    $mail->Host = "mail.oceansoftwares.in";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     
    $mail->Username = "gowtham@oceansoftwares.in";
    $mail->Password = "Ocean@123456";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "ssl";
    //Set TCP port to connect to
    $mail->Port = 465;
    $mail->From = $_POST["email"];
    $mail->FromName = $_POST["name"];
    $mail->addAddress("gowthamsakthi2520@gmail.com", "ocean softwares");
    $mail->isHTML(true);
    $mail->Subject = $type . " Form";
    $mail->addAttachment('uploads/'.$name);

    if (!empty($_POST['type']) != "") {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $Body = "";
        $Body .= "<table><tr><th>Name</th><td>$name</td></tr><tr><th>Phone</th><td>$phone</td></tr><tr><th>Email</th><td>$email</td></tr><tr><th>subject</th><td>$subject</td></tr><tr><th>Message</th><td>$message</td></tr></table>";
    }

    $mail->Body = $Body;


    try {
        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo $e->getMessage();
    }

} 