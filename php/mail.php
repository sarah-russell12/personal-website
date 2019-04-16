<?php

define("MAIL_TO", "sarah.russell12@ncf.edu");

function processMailForm() {
	list($name, $email, $company, $submittedMessage) = validateFormInformation();
	
	$header = constructHeader($email);
	$message = constructMessage($name, $company, $submittedMessage);
}


// The form validation code is put together from snippets from TutorialRepublic's PHP tutorial
// which allows the use of code snippets for personal and conmercial projects in their terms of use
// (www.tutorialrepublic.com/terms-of-use.php)
function validateFormInformation() {
	$name = validateText($_POST["name"]);
	$email = validateEmail($_POST["email"]);
	$company = validateText($_POST["company"]);
	$message = validateMessage($_POST["message"]);
	
	$arr = array($name, $email, $company, $message);
	
	return $arr;
}

function validateText($text) {
	
}

function validateEmail($email) {
	
}



processMailForm();

?>