<?php
require('../model/database.php');
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'home_index';
    }
}
switch ($action) {
    case 'about':
        include('about.php');
        break;
    case 'contact':
        $contact_error = '';
        include('contact.php');
        break;
    case 'home_index':
        include('../index.php');
    break;
    case 'contacting':
        $contact_error = '';
        $name = filter_input(INPUT_POST, 'name');
        $email_address = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $phone = filter_input(INPUT_POST, "phone");
        $message = filter_input(INPUT_POST, "message");
        // Check for empty fields
        if(empty($name) || empty($email_address) || empty($phone) || empty($message) || !filter_var($email_address,FILTER_VALIDATE_EMAIL)) {
        $contact_error = "No arguments Provided!";
        include('contact.php');
        return false;
        }
        
        // Create the email and send the message
        $to = 'sidarghost@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Website Contact Form:  $name";
        $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: noreply.classychess@gmail.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To: $email_address";   
        // mail($to,$email_subject,$email_body,$headers);
        $full_email = $to." ".$email_subject." ".$email_body." ".$headers;
        $contact_error = $full_email;
        // $contact_error = "Message sent!";
        include('contact.php');
        return true;           
    break;
}
?>