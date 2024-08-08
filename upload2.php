<?php

require 'smtp/PHPMailerAutoload.php';

$con = mysqli_connect('localhost', 'root', '', 'crm_data') or die();

if (isset($_REQUEST['submit'])) {
    $name = $user_name = $_POST['name'];
    $email = $_POST['email'];
    $file = $_FILES['file'];

    $filename = $_FILES['file']['name'];
    $filetyp = $_FILES['file']['type'];
    $filetemp = $_FILES['file']['tmp_name'];

    $location = "upload/";
    $img = $location . $filename;

    $target = "upload/";
    $finalImage = $target . $filename;

    move_uploaded_file($filetemp, $finalImage);

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
        $user_email = $email;
        $mail->From = 'support@litem.in';
        $mail->FromName = 'Litem Legalis llp';
        $mail->addAddress($user_email);
        $mail->addReplyTo('support@litem.in', 'Welcome');
        
        // Add BCC to your email address
        $mail->addBCC('support@litem.in'); // Replace with your actual email address

        $mail->WordWrap = 50;
        $mail->isHTML(true);

        $mail->Subject =  ' | ' . 'Litem Legalis llp';
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
                <div style="width:98%;margin:42px auto 30px;">
                    <a style="margin:auto;background: #32d314;font-size:18px;font-weight:500;height:19px;padding:10px;width:250px;letter-spacing:normal;line-height:100%;text-align:center;text-decoration:none;color:#ffffff;display:block;border-radius:8px;" href="https://tidycal.com/professionalutilities/free-consultation" title="Free Video Consultation" target="_blank">Free Video Consultation</a>
                </div>
                <div style="width:100%;margin: auto;margin-top: 50px;">
                    <p style="font-size:23px;font-weight:600;margin:10px 0px 0px 0px;text-align:center;color:#0c3c63;font-family: Arial;">Why Professional Utilities</p>
                    <hr style="width: 40px;color:#32d314;background-color: #32d314;text-align: center;opacity: 1;border: 1.95px solid #32d314;margin-top:2px;">
                    <img src="https://www.professionalutilities.com/images/email/why_professional_utilities_1.png" width="100%" alt="why professional utilities">
                </div>
                <div style="width:98%;margin:auto;">
                    <p style="font-size:17px;margin-bottom: 0px;font-weight: 500;line-height: 32px;font-family: Arial;">Best Regards,</p>
                    <p style="font-size:17px;margin-top: 0px;margin-bottom:0px;font-weight: 600;font-family: Arial;">Team Professional Utilities</p>
                </div>
                <div style="width:80%;display: flex;margin:30px auto;text-align: center;">
                    <a href="https://www.facebook.com/theprofessionalutilities" target="_blank" style="width: 80%"><img src="https://www.professionalutilities.com/images/email/facebook.png" alt="facebook" width="32px"></a>
                    <a href="https://www.facebook.com/theprofessionalutilities" target="_blank" style="width: 80%"><img src="https://www.professionalutilities.com/images/email/instagram.png" alt="instagram" width="32px"></a>
                    <a href="https://in.linkedin.com/company/professional-utilities" target="_blank" style="width: 80%"><img src="https://www.professionalutilities.com/images/email/linkedin.png" alt="linked-in" width="32px"></a>
                    <a href="https://twitter.com/ProfessionalUt1" target="_blank" style="width: 80%"><img src="https://www.professionalutilities.com/images/email/twitter.png" alt="twitter" width="32px"></a>
                    <a href="https://in.pinterest.com/professionalutilities/" target="_blank" style="width: 80%"><img src="https://www.professionalutilities.com/images/email/pinterest.png" alt="pinterest" width="32px"></a>
                    <a href="https://www.professionalutilities.com/" target="_blank" style="width: 80%"><img src="https://www.professionalutilities.com/images/email/website.png" alt="website" width="32px"></a>
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

        echo "<script>alert('file is uploading');window.location.href='index.php'</script>";
    } else {
        echo "Something went wrong";
    }
}
?>






