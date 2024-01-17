<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM faculty_login where username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Details Found";
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: fdashboard.php ");
    }
    else{
        echo "Invalid Credentials";
    }
}




?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faculty Login</title>
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<body class="my-login-page">
<section class="h-100">
    <div class="container h-100">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card-wrapper">
                <div class="card fat">
                    <div class="card-body">
                        <img src="amrita.png" alt="Logo" class="login-logo">
                        <h4 class="card-title">CRMS</h4>
                        <form method="POST" class="my-login-validation" novalidate="" >
                            <div class="form-group">
                                <label for="username">Username or Email</label>
                                <input id="username" type="text" class="form-control rounded-pill" name="username" value="" required
                                       autofocus>
                                <div class="invalid-feedback">
                                    Username or Email is required
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password
                                    <a href="forget_pass.php" class="float-right" id="decoration">
                                        Forgot Password?
                                    </a>
                                </label>
                                <input id="password" type="password" class="form-control rounded-pill" name="password">
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>


                            <div class="form-group m-0">
                                <button type="submit"  class="btn btn-primary btn-block btn rounded-pill">
                                    Login
                                </button>
                                <a href="dashboard.html" id="redirect-link"></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>
