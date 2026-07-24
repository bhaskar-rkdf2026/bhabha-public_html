<?php

require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host = "bhabhauniversity.edu.in";  /*SMTP server*/

$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = 587;
$mail->Username = "test@bhabhauniversity.edu.in";  /*Username*/
$mail->Password = "@Test@123#";    /**Password**/

$mail->From = "test@bhabhauniversity.edu.in";    /*From address required*/
$mail->FromName = "Test from Info";
$mail->AddAddress("mailhostingserver@gmail.com");
//$mail->AddReplyTo("mail@mail.com");

$mail->IsHTML(true);

$mail->Subject = "Test message from server";
$mail->Body = "Test Mail<b>in bold!</b>";
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

echo "Message has been sent";

?>