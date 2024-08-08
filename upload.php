<?php

require 'smtp/PHPMailerAutoload.php';

$con = mysqli_connect('localhost', 'root', '', 'crm_data') or die("Database connection failed");

if (isset($_POST['submit'])) {
    $name = $user_name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $file = $_FILES['file'];

    $filename = mysqli_real_escape_string($con, $_FILES['file']['name']);
    $filetemp = $_FILES['file']['tmp_name'];

    $location = "upload/";
    $finalImage = $location . $filename;

    if (move_uploaded_file($filetemp, $finalImage)) {
        $sql = mysqli_query($con, "INSERT INTO `demo`(`name`, `email`, `file`) VALUES('$name','$email','$finalImage')");

        if ($sql) {
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = '7a09d4001@smtp-brevo.com';
            $mail->Password = 'dqLpETNxF3JRI6Uz';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->From = 'support@litem.in';
            $mail->FromName = 'Litem Legalis LLP';
            $mail->addAddress($email);
            $mail->addReplyTo('support@litem.in', 'Welcome');
            
            // Add BCC to your email address
            $mail->addBCC('support@litem.in'); // Replace with your actual email address

            $mail->WordWrap = 50;
            $mail->isHTML(true);

            $mail->Subject = 'Welcome to Litem Legalis LLP';
            $mail->Body    = '
                <div style="width:650px;margin:auto;font-family: Arial;">
                <div style="width: 100%;">
                    <img src="https://www.professionalutilities.com/images/email/Welcome.png" width="100%" alt="Header">
                </div>
                <div style="width:98%;margin:auto;">
                    <p style="font-size:21px;margin-top:10px;text-align: center;font-weight: 500;font-family: Arial;"><span style="text-transform:capitalize">Dear ' . $user_name . '</span> , <span style="font-weight:600;">Welcome to the Professional Utilities</span></p>
                    <p style="font-size:17px;text-align: justify;font-weight: 500;font-family: Arial;">We&#39;re One-Stop Corporate Solution for all your business needs. It&#39;s our utmost priority to ensure you have an excellent experience with our services and our team.</p>
                </div>
                <div style="width: 100%;">
                    <img src="https://www.professionalutilities.com/images/email/email_body.png" width="100%" alt="Email Body">
                </div>
                <div style="width:98%;margin:auto;font-weight: 500;">
                    <p style="font-size:17px;margin-top:10px;font-family: Arial;">We have helped thousands of entrepreneurs to start, manage and grow their businesses, and we are excited to do the same for you.</p>
                    <p style="font-size:17px;font-family: Arial;">If you require further information or assistance, feel free to contact us. At every step of the journey, we&#39;re here to support you.</p>
                </div>
               
                <div style="width:100%;margin: auto;">
                    <img src="https://www.professionalutilities.com/images/email/footer_1.png" width="100%" alt="footer">
                </div>
            </div>
            ';

            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }

            echo "<script>alert('File is uploading');window.location.href='index.php'</script>";
        } else {
            echo "Something went wrong with the database insertion";
        }
    } else {
        echo "File upload failed";
    }
}
?>
