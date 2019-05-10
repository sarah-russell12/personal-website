<?php

function processMailForm() {
	$formInformation = validateFormInformation();
	
	if ($formInformation != FALSE) {
		$header = constructHeader($formInformation["email"]);
		$message = constructMessage($formInformation["name"], $formInformation["company"], $formInformation["message"]);
		mail("sarah.russell12@ncf.edu", $_POST["subject"], $message, $header);
	}
}


// The form validation code is put together from snippets from TutorialRepublic's PHP tutorial
// which allows the use of code snippets for personal and conmercial projects in their terms of use
// (www.tutorialrepublic.com/terms-of-use.php)
function validateFormInformation() {
	$name = validateText($_POST["name"]);
	$email = validateEmail($_POST["email"]);
	$company = validateText($_POST["company"]);
	$message = validateMessage($_POST["message"]);
	
	if ($name != FALSE && $email != FALSE && $company != FALSE && $message != FALSE) {
		$arr = array("name"=>$name, "email"=>$email, "company"=>$company, "message"=>$message);
		return $arr;
	} else {
		return FALSE;
	}
}

function validateText($text) {
	$sanitizedText = filter_var(trim($text), FILTER_SANITIZE_STRING);
	
	$alphaRegexp = array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"));
	
	if (!empty($sanitizedText) && filter_var($sanitizedText, FILTER_VALIDATE_REGEXP, $alphaRegexp)) {
		return $sanitizedText;
	} else {
		return FALSE;
	}	
}

function validateEmail($email) {
	$sanitizedEmail = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
	
	if (!empty($sanitizedEmail) && filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
		return $sanitizedEmail;
	} else {
		return FALSE;
	}
}

function validateMessage($message) {
	$sanitizedMessage = filter_var(trim($message), FILTER_SANITIZE_STRING);
	
	if (!empty($sanitizedMessage)) {
		return $sanitizedMessage;
	} else {
		return FALSE;
	}
}

function constructHeader($email) {
	$header = "From: ".$email."\r\n"."X-Mailer: PHP/".phpversion();
	return $header;
}

function constructMessage($name, $company, $submittedMessage) {
	$message = "This is a message from ".$name." representing the company ".$company.": \r\n".$submittedMessage;
	return $message;
}



processMailForm();

?>