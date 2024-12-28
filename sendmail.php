<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');
$allowedOrigin = 'http://localhost:5173';
include "mailConfig.php";
$inputData = json_decode(file_get_contents('php://input'), true);


if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] == $allowedOrigin) {

    if ($inputData) {
        $email = $inputData['email'];
        $subject = $inputData['subject'];
        $message = $inputData['message'];

        $response = [
            "status" => "success",
            "message" => "Email sent successfully!"
        ];

        if (!empty($email) && !empty($subject) && !empty($message)) {
            $mail_send = new Sendmail();
            $mail_send->sendEmail($email, $subject, $message);
        }
    } else {
        $response = [
            "status" => "error",
            "message" => "Invalid input data."
        ];
    }
} else {
    http_response_code(403);
    echo "Access denied: Invalid origin.";
}

echo json_encode($response);
