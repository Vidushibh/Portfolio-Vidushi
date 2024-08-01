<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(500);
        exit();
    }

    // Sanitize form inputs
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $m_subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message = strip_tags(htmlspecialchars($_POST['message']));

    // Email configuration
    $to = "vidushibhrgv@gmail.com"; // Your email address
    $subject = "$m_subject: $name";
    $body = "You have received a new message from your website contact form.\n\n"
          . "Here are the details:\n\n"
          . "Name: $name\n"
          . "Email: $email\n"
          . "Subject: $m_subject\n"
          . "Message: $message";
    $header = "From: $email\r\n";
    $header .= "Reply-To: $email\r\n";
    $header .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if(!mail($to, $subject, $body, $header)) {
        http_response_code(500);
        exit();
    }

    http_response_code(200);
    echo "success";
}
?>
