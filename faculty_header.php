<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $username = $_SESSION["username"]; // Assuming the username is stored in the session
    echo "<div class='header'>
        <nav class='navbar'>
          <div class='logo'>
          <img src='amrita.png' alt='Logo' style='width: 130px; height: 50px;'> 
          </div>    
        <h1 class='navbar-brand'>CRMS</h1>
          <div class='navbar-right'>
            <div class='dropdown'>
              <a  class='welcome-text'>Welcome, $username<i class='fas fa-caret-down'></i></a>
              <div class='dropdown-content user-dropdown'>
               <p class='logout-menu' ></p>
                <a  href='login.php'>Logout</a>
              </div>
            </div>
      
            <div class='navbar-time'>
              <p class='current-time'></p>
            </div>
            <div class='dropdown'>
            <a class='notification-button' href='faculty_read_msg.php'><i class='fas fa-bell'>";

    // Replace 'YOUR_DB_HOST', 'YOUR_DB_USERNAME', 'YOUR_DB_PASSWORD', and 'YOUR_DB_NAME' with your actual database credentials
    $con = mysqli_connect('localhost','root','','notify');
    if ($con) {
        $sql_get = mysqli_query($con, "SELECT * FROM message WHERE status = 0");
        $count = mysqli_num_rows($sql_get);
        echo "<span class='badge badge-danger' id='count'>$count</span>";
        //mysqli_close($con);
    } 
            
    echo "</a></div></nav></div>";
} else {
    // Display a login link
    echo "<div class='header'>
        <nav class='navbar'>
          <div class='logo'>
          <img src='amrita.png' alt='Logo'  style='width: 130px; height: 50px;> 
            </div>    
        <h1 class='navbar-brand'>CRMS</h1>
          <div class='navbar-right'>
            <div class='dropdown'>
              <a  class='welcome-text'>Welcome, <i class='fas fa-caret-down'></i></a>
              <div class='dropdown-content user-dropdown'>
               <p class='logout-menu' ></p>
                <a  href='fac_login.php'>Login</a>
              </div>
            </div>

            <div class='navbar-time'>
              <p class='current-time'></p>
            </div>
            <div class='dropdown'>
            <a class='notification-button' href='faculty_read_msg.php'><i class='fas fa-bell'></i></a>;
            
            
          </div>
          
         
        </nav>
        
      </header>";
}
?>
