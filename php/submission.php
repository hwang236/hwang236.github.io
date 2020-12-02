<?php
/* This php code is for submitting forms, 
	it is base on the code provided here https://www.freecontactform.com/form-guides/html-email-form */
	if (isset($_POST['Email'])) {

    $email_to = "hemingwang2021@u.northwestern.edu";
    $email_subject = "New form submissions from my portfolio website";
    $email_copy_subject = "A copy of your message sent to Heming Wang";

    function problem($error)
    {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['fullname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject'])
    ) {
        problem('Sorry, but there appears to be a problem with the form you submitted.');
    }

    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $affiliation = $_POST['affiliation'];
    $message = $_POST['subject'];
    $requestCopy = false;
    if ($_POST['requestcopy']) {
        $requestCopy = true;
    }

    if (strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Company/Institution: " . clean_string($affiliation) . "\n";
    $email_message .= "Subject: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
    if ($requestCopy) {
        @mail($email, $email_copy_subject, $email_message, $headers);
    }
?>
Thank you for contacting me. I will be in touch with you very soon.
<?php
}
?>
