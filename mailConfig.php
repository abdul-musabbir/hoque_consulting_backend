<?php

// Include PHPMailer autoload file (use Composer or include manually)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer

// Create a new PHPMailer instance
class Sendmail
{
    private $mail;

    // Constructor to initialize PHPMailer settings
    public function __construct()
    {
        // Initialize PHPMailer instance
        $this->mail = new PHPMailer(true);

        try {
            //Server settings
            $this->mail->isSMTP(); // Set mailer to use SMTP
            $this->mail->Host = 'smtp.gmail.com'; // Set the SMTP server to Gmail's
            $this->mail->SMTPAuth = true; // Enable SMTP authentication
            $this->mail->Username = 'midbox.io@gmail.com'; // Your email address
            $this->mail->Password = 'sqzagklreeyjuvzg'; // Your email password or app-specific password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $this->mail->Port = 587; // TCP port to connect to

            // Default sender settings
            $this->mail->setFrom('midbox.io@gmail.com', 'MidBox'); // Your email and name
        } catch (Exception $e) {
            echo "Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    // Method to send email with dynamic content
    public function sendEmail($email, $subject, $message)
    {
        try {
            // Recipients
            $this->mail->addAddress($email); // Add the recipient's email address

            // Content
            $this->mail->isHTML(true); // Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body = "
            <html>
            <head>
                <title>$subject</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        color: #333;
                        margin: 20px;
                    }
                    .email-container {
                        width: 100%;
                        max-width: 600px;
                        margin: auto;
                        padding: 20px;
                        background-color: #f4f4f4;
                        border-radius: 8px;
                    }
                    .email-header {
                        text-align: center;
                        font-size: 24px;
                        font-weight: bold;
                        color: #0056b3;
                    }
                    .email-content {
                        margin-top: 20px;
                    }
                    .email-footer {
                        margin-top: 30px;
                        font-size: 12px;
                        text-align: center;
                        color: #777;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='email-header'>
                        <h2>$subject</h2>
                    </div>
                    <div class='email-content'>
                        <h3><strong>From:</strong> $email</h3>
                        <h3><strong>Message:</strong> $message</h3>
                    </div>
                    <div class='email-footer'>
                        <p>Thank you for contacting us!</p>
                        <p>Your Company Name</p>
                    </div>
                </div>
            </body>
            </html>
            ";
            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}
