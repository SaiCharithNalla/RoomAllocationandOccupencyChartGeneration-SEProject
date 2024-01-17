<?php
    session_start();

    // Check if the user is already logged in
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        // Redirect the user to the dashboard or home page
        header("Location: dashboard.php"); // Replace "dashboard.php" with your desired page
        exit;
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Perform validation and authentication
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "room_booking");

        // Prepare a SQL statement to retrieve user details
        $sql = "SELECT * FROM login_details WHERE email = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        // Check if the query returned a row
        if (mysqli_num_rows($result) == 1) {
            // Fetch the user details
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["id"];
            $user_name = $row["name"];
            $user_role = $row["role"];

            // Authentication successful
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $user_name;
            $_SESSION["user_role"] = $user_role;

            // Redirect the user to the dashboard or home page
            header("Location: index.php"); // Replace "dashboard.php" with your desired page
            exit;
        } else {
            // Invalid username or password
            $error = "Invalid username or password.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f2f2f2;
        }
        .container {
            margin-top: 150px;
            display: inline-block;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label, input {
            display: block;
            font-size: 16px;
        }
        input[type="text"], input[type="password"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
        }
        .submit-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
            if (isset($error)) {
                echo "<div class='error'>$error</div>";
            }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="submit-btn">
            </div>
        </form>
    </div>
</body>
</html>
