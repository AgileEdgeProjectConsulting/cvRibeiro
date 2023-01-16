<?php

// Replace this with your own email address
$siteOwnersEmail = 'aribeiro13@outlook.com';


if($_POST) {

   $firstName = trim(stripslashes($_POST['contactFirstName']));
   $lastName = trim(stripslashes($_POST['contactLasttName']));
   $phone = trim(stripslashes($_POST['contactPhone']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

   	// Check First Name
	if (strlen($firstName) < 2) {
		$error['firstName'] = "Please enter your first name.";
	}
  	// Check Last Name
	if (strlen($lastName) < 2) {
		$error['lastName'] = "Please enter your last name.";
	}
	// Check Phone
	if (!preg_match('/^[+]?[1-9][0-9]{9,14}$/', $phone)) {
		$error['phone'] = "Please enter a valid phone number.";

	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address.";
	}
	// Check Message
	if (strlen($contact_message) < 15) {
		$error['message'] = "Please enter your message. It should have at least 15 characters.";
	}
  	 // Subject
	if ($subject == '') { $subject = "Contact Form Submission"; }


   // Set Message
   $message .= "Email from: " . $firstName + $lastName . "<br />";
	$message .= "Email address: " . $email . "<br />";
   $message .= "Message: <br />";
   $message .= $contact_message;
   $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

   // Set From: header
   $from =  $firstName . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


   if (!$error) {

      ini_set("sendmail_from", $siteOwnersEmail); // for windows server
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Something went wrong. Please try again."; }
		
	} # end if - no validation error

	else {

		$response = (isset($error['firstName'])) ? $error['firstName'] . "<br /> \n" : null;
		$response = (isset($error['lastName'])) ? $error['lasttName'] . "<br /> \n" : null;
		$response .= (isset($error['phone'])) ? $error['phone'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	} # end if - there was a validation error

}

?>
