<?php
// Check if form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = strip_tags(trim($_POST["name"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    // Validate form data
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        http_response_code(400);
        echo json_encode(["message" => "Please fill in all fields."]);
        exit;
    }

    // Set recipient email address
    $to = "bandivinod3741@gmail.com";

    // Set email subject
    $subject = "New Enquiry from Contact Form";

    // Build email content
    $email_content = "Name: $name\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Set additional headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        // Email sent successfully
        http_response_code(200);
        echo json_encode(["message" => "Thank you! Your message has been sent."]);
    } else {
        // Error sending email
        http_response_code(500);
        echo json_encode(["message" => "Oops! Something went wrong and we couldn't send your message."]);
    }
} else {
    // Not a POST request
    http_response_code(403);
    echo json_encode(["message" => "There was a problem with your submission, please try again."]);
}

