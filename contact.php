<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the name field
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameError = "Only letters and white space allowed";
        }
    }

    // Validate the email field
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

    // Validate the subject field
    if (empty($_POST["subject"])) {
        $subjectError = "Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
    }

    // Validate the message field
    if (empty($_POST["message"])) {
        $messageError = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }

    // If there are no errors, send the email
    if (!$nameError &&!$emailError &&!$subjectError &&!$messageError) {
        $to = "kevinjulu@gmail.com";
        $subject = "New message from $name";
        $message = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";
        $headers = "From: $email";
        mail($to, $subject, $message, $headers);
        $success = "Message sent successfully";
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>