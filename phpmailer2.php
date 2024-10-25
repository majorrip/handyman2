<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
function sendmail($tomail, $totmailname , $subject, $message)
{
	$loginid 	= "onlineauctionprojectmail@myprojectcoding.xyz";
	$password 	= "h?eeL$9e0lp6";
	$smtpserver = "mail.myprojectcoding.xyz";
	$smtpport 	= 26;
	$mailsender = "OnlineAuction";
	// Load Composer's autoloader
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = false; // SMTP::DEBUG_SERVER; // Enable verbose debug output
		$mail->isSMTP();          // Send using SMTP
		$mail->Host       = $smtpserver; // Set the SMTP server to send through
		$mail->SMTPAuth   = true;  // Enable SMTP authentication
		$mail->Username   = $loginid; // SMTP username
		$mail->Password   = $password;  // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = $smtpport;
		// TCP port to connect to

		//Recipients
		$mail->setFrom($loginid, $mailsender);
		$mail->addAddress($tomail, $totmailname);     // Add a recipient
		$mail->addAddress($tomail);               // Name is optional
		$mail->addReplyTo($tomail, $totmailname);
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		// Attachments
	  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->AltBody = 'Mail Receieved';

		$mail->send();
			//echo 'Message has been sent';
	} 
	catch (Exception $e) 
	{
		echo "Message could not be sent. Mailer Error: {
			$mail->ErrorInfo}";
	}
}
sendmail("studentprojects.live@gmail.com", "Student Projects" , "My subject title", "My message");
?>