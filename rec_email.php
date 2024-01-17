<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include '_dbconnect.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; // Retrieve the entered email from the form

    // Validate the email (you can add more validation if required)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address';
        exit;
    }

    // Generate a unique token for the password reset link
    $token = generateRandomString(32); // You can use any method to generate a secure random string

    // Save the token in the database or any other persistent storage associated with the user
    $createTableQuery = "CREATE TABLE IF NOT EXISTS password_reset_tokens (
        email VARCHAR(255) NOT NULL,
        token VARCHAR(32) NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (email)
    )";

    if ($conn->query($createTableQuery) !== TRUE) {
        echo "Error creating table: " . $conn->error;
        exit;
    }

    // Insert or update the token for the email
    $insertTokenQuery = "INSERT INTO password_reset_tokens (email, token) VALUES (?, ?)
        ON DUPLICATE KEY UPDATE token = ?";


    $insertTokenQuery = "INSERT INTO password_reset_tokens (email, token) VALUES (?, ?)";
    $stmt = $conn->prepare($insertTokenQuery);
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->close();

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                   // Enable SMTP authentication
        $mail->Username   = 'nallacharith67@gmail.com';     // SMTP username
        $mail->Password   = 'xjptmyliksqbflyp';            // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('nallacharith67@gmail.com', 'Nalla');
        $mail->addAddress($email);                  // Add the recipient email address

        // Content
        $mail->isHTML(true);                         // Set email format to HTML
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Click the following link to reset your password: <a href="http://localhost:80/project/reset.php?token=' . $token . '">Reset Password</a>';
        //echo $token;

        $mail->send();
        echo 'Email has been sent successfully!';
    } catch (Exception $e) {
        echo "Email sending failed: {$mail->ErrorInfo}";
    }
}

/**
 * Generate a random string of specified length
 *
 * @param int $length Length of the string
 * @return string Random string
 */
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $charactersLength = mb_strlen($characters, 'utf-8'); // Specify the character encoding

    for ($i = 0; $i < $length; $i++) {
        $randomString .= mb_substr($characters, rand(0, $charactersLength - 1), 1, 'utf-8'); // Specify the character encoding
    }

    return $randomString;
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 4px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease-in-out;
        }

        .container:hover {
            background-color: #ebebeb;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <br><br><br><br>
    <div class="container">
        <form method="POST" action="">
            <label for="email">Enter your email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
