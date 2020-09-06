<?php 
    if(isset($_POST['sendMail'])) {

        require 'PHPMailerAutoload.php';
        require 'credential.php';

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASS;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom(EMAIL, $_POST['first_name']);
        $mail->addAddress(EMAIL);     // Add a recipient

        $mail->addReplyTo($_POST['email']);
        
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = "Contact Query";
        $mail->Body    = "<strong>Name: </strong>". $_POST['first_name'] ."<br>";
        $mail->Body .= "<strong>Email: </strong>". $_POST['email'] ."<br>";
        $mail->Body .= "<strong>Phone: </strong>". $_POST['phone'] ."<br>";
       // $message_Body .= "<strong>Subject: </strong>". $user_Subject ."<br>";
        $mail->Body .= "<strong>Message: </strong>". $_POST['message'] ."<br>";;
        $mail->AltBody = $_POST['message'];

        if(!$mail->send()) {
            echo "Let's try again.";
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "You made it.";
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Send Email</title>
    </head>

    <body>
       <h1>Contact Form</h1>
        <form class="contact-form" role="form" method="POST">
            <input class="form-control" type="text" placeholder="First Name:" required="" id="first_name" name="first_name">
            <input class="form-control" type="email" placeholder="Email:" required="" id="email" name="email">
            <input class="form-control" type="tel" placeholder="Phone:" id="phone" name="phone">
            <textarea class="form-control" placeholder="Message" id="message" required="" name="message"></textarea>
            <button type="submit" name="sendMail" id="sendMail"><span>Contact Now</span></button>
        </form>
    </body>
</html>