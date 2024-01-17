<?php
include '_dbconnect.php';

// Retrieve the token from the URL query string
$token = $_GET['token'];

// Retrieve the email associated with the token from the database
$selectEmailQuery = "SELECT email FROM password_reset_tokens WHERE token = ?";
$stmt = $conn->prepare($selectEmailQuery);
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

$sql = "SELECT * FROM password_reset_tokens WHERE token = '$token'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $mail = $row['email'];
} else {
    echo "Query failed: " . mysqli_error($conn);
}

$sql = "SELECT * FROM student WHERE email = '$mail'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $student_id = $row['student_id'];
} else {
    echo "Query failed: " . mysqli_error($conn);
}

if ($email) {
    // Display the password reset form
    echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Reset Password</title>
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

                input[type="password"] {
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
                <form method="POST">
                    <label for="password">New Password:</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                    <label for="confirm_password">Retype Password:</label><br>
                    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                    <input type="hidden" name="email" value="' . $email . '">
                    <input type="hidden" name="token" value="' . $token . '">
                    <input type="submit" value="Reset">
                </form>
            </div>
        </body>
        </html>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo 'Passwords do not match.';
        exit;
    }

    $sql = "UPDATE student_login
        SET password = '$password'
        WHERE username = '$student_id'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $affectedRows = mysqli_affected_rows($conn);
        if ($affectedRows > 0) {
            echo "Password updated successfully.";
        } else {
            // echo "No matching student ID found.";
        }
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
} else {
    //echo 'Invalid token';
}
?>
