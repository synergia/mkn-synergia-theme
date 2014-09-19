<?php
# Change to your e-mail
$recip = "name@domain.com";
$from_header = "From: name@domain.com";

/**************************************************************************/
$contact_name = $_POST['fromName'];
$contact_email = $_POST['emailTo'];
$contact_message = $_POST['message'];

$spamCheck = $_POST['javacheck'];

if ($spamCheck != "negative") {
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/plain; charset=utf-8\n";
	$headers .= "X-Priority: 3\n";
	$headers .= "X-MSMail-Priority: Normal\n";
	$headers .= "X-Mailer: php\n";
	$headers .= $from_header;
	
	// build up message
	// this code for any multiline text fields
	$message = str_replace("\r", "\n", $contact_message);
	// info vars
	$sender = $_SERVER[REMOTE_ADDR];
	// you can rearrange this - just do not add or remove quotes
	$mailbody = "Contact form send by:
	Name: $contact_name
	Email: $contact_email
	
	Message:
	$contact_message
	-------
	sender's ip: $sender";
	
	mail($recip, "Contact form", $mailbody, $headers);
} else {
	echo "error";
}

?>