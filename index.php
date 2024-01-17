<?php
include_once 'connection.php';

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $msg = $_POST['msg'];
    $date = date('Y-m-d H:i:s');

    $sql_insert = mysqli_query($con, "INSERT INTO message(name, message, cr_date) VALUES ('$name', '$msg', '$date')");
    if ($sql_insert) {
        echo '<script>alert("Message sent!");</script>';
    } else {
        echo mysqli_error($con);
        exit;
    }
}

// Fetch unread notifications
$sql_get = mysqli_query($con, "SELECT * FROM message WHERE status=0");
$count = mysqli_num_rows($sql_get);

// Update status of fetched notifications
if ($count > 0) {
    $notificationIds = [];
    while ($result = mysqli_fetch_assoc($sql_get)) {
        $notificationIds[] = $result['id'];
    }
    $notificationIdsString = implode(',', $notificationIds);
    $sql_update = mysqli_query($con, "UPDATE message SET status=1 WHERE id IN ($notificationIdsString)");
    if (!$sql_update) {
        echo mysqli_error($con);
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
          <link rel="stylesheet" type="text/css" href="styled.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
    <style>
      .notification-dropdown {
        right: 0; /* Add this to align the dropdown to the right */
      }
    </style>    <title>NOTIFICATIONS</title>
</head>
<body>

<header>
    <nav class="navbar">
        <div class="dropdown">
            <button class="dropbtn">
                <div class="container">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </button>
            <div class="dropdown-content">
                <a href="#">Accounts</a>
                <a href="#">Classrooms</a>
                <a href="occupancychart.html">View Chart</a>
                <a href="#">Loghistory</a>
            </div>
        </div>

        <h1 class="navbar-brand">CRMS</h1>
        <div class="navbar-right">
            <div class="dropdown">
                <a class="welcome-text">Welcome, [User Name]<i class="fas fa-caret-down"></i></a>
                <div class="dropdown-content user-dropdown">
                    <!--<a href="#">Switch Accounts</a> -->
                    <p class="logout-menu"></p>
                    <a href="login.php">Logout</a>
                </div>
            </div>

            <!--<p class="welcome-text">Welcome, [User Name]</p>-->
            <div class="navbar-time">
                <p class="current-time"></p>
            </div>
            <div class="dropdown">
                <a class="notification-button" href="read_msg.php">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-danger" id="count"><?php echo $count; ?></span>
                </a>
             <!--   <div class="dropdown-content notification-dropdown">
                    <a href="#">Switch Accounts</a> 
                    <p class="notification-menu"></p>
                    <a href="read_msg.php">My Notifications</a> 
                </div>  
            </div>
        </div>
    </nav>
</header>

<!-- Rest of your HTML content -->

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
-->
</body>
</html>
