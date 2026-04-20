<?php
header('Content-Type: application/json');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    // 🔐 SMTP Settings (Zoho)
    $mail->isSMTP();
    $mail->Host       = 'smtp.zoho.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'admissions@kamilaviation.com'; // Zoho email
    $mail->Password   = 'cU9bF9r4LWeu'; // or App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // 👤 Sender & Receiver
    $mail->setFrom('admissions@kamilaviation.com', 'Website Enquiry');
    $mail->addAddress('maneeshunnikuttan@gmail.com'); // where you receive

    // 📩 Form Data
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $course  = $_POST['course'];
    $message = $_POST['message'];

    // ✉️ Email Content
    $mail->isHTML(true);
    $mail->Subject = 'New Enquiry from Website';
    $mail->Body    = "
        <h3>New Enquiry</h3>
        <p><b>Name:</b> $name</p>
        <p><b>Email:</b> $email</p>
        <p><b>Phone:</b> $phone</p>
        <p><b>Course:</b> $course</p>
        <p><b>Message:</b> $message</p>
    ";

    $mail->send();
    echo json_encode(["status" => "success"]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "msg" => $mail->ErrorInfo]);
}