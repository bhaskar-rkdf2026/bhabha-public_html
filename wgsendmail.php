<?php
require_once('config.php');

$to = "rajeev@bhabhauniversity.edu.in";
$subject= "New Whatsapp group joining";
$todayis = date("l, F j, Y, g:i a") ;

$subject= "Bhabha University, Bhopal, for Whatsapp group joining ";
$name = $_POST['name'] ?? '';
$fname = $_POST['fname'] ?? '';
$desig = $_POST['desig'] ?? '';
$depart = $_POST['depart'] ?? '';
$tdate = $_POST['tdate'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? 'info@bhabhauniversity.edu.in';

$message = "
Date ------- $todayis
Name ------ $name
Father Name ------ $fname
Designation ------ $desig
Department ------ $depart
Date of Joining- $tdate
Mobile No. ------ $phone



";
  $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
         $headers = "From: $email\r\n" .
         "MIME-Version: 1.0\r\n" .
            "Content-Type: multipart/mixed;\r\n" .
            " boundary=\"{$mime_boundary}\"";
         $message = "This is a multi-part message in MIME format.\n\n" .
            "--{$mime_boundary}\n" .
            "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" .
         $message . "\n\n";
         if (!empty($_FILES)) {
             foreach($_FILES as $userfile)
             {
                $tmp_name = $userfile['tmp_name'] ?? '';
                $type = $userfile['type'] ?? 'application/octet-stream';
                $fileName = $userfile['name'] ?? 'file';
                $size = $userfile['size'] ?? 0;
                if (!empty($tmp_name) && file_exists($tmp_name))
                {
                   if(is_uploaded_file($tmp_name))
                   {
                      $file = fopen($tmp_name,'rb');
                      $data = fread($file,filesize($tmp_name));
                      fclose($file);
                      $data = chunk_split(base64_encode($data));
                   }
                   $message .= "--{$mime_boundary}\n" .
                      "Content-Type: {$type};\n" .
                      " name=\"{$fileName}\"\n" .
                      "Content-Disposition: attachment;\n" .
                      " filename=\"{$fileName}\"\n" .
                      "Content-Transfer-Encoding: base64\n\n" .
                   $data . "\n\n";
                }
             }
         }
         $message.="--{$mime_boundary}--\n";
if (mail($to, $subject, $message, $headers))
   echo "Thank you !!\n
Document and Information Submitted Successfully for official Bhabha University Whatsapp group joining.\n

For Support Call Us on +91-9039921140 or Email at info@bhabhauniversity.edu.in.\n
 <a href='" . href('wgform.php') . "'> <h1>Back</h1> </a>";
else
   echo "Error in mail";

?>