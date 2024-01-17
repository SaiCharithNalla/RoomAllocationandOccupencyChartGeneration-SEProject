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

    
      
            <!--<p class='welcome-text'>Welcome, [User Name]</p>-->
            <div class='navbar-time'>
              <p class='current-time'></p>
            </div>
            <div class='dropdown'>
            <a class='notification-button'><i class='fas fa-bell'></i></a>
            <div class='dropdown-content notification-dropdown'>
              <p class='notification-menu' ></p>
              
               <a  href='send_msg.php'>send notification</a>
               <a  href='faculty_read_msg.php'>my notification</a>
             </div>
          </div>
          
         
        </nav>
        
      </header>";
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
                <a  href='login.php'>Login</a>
              </div>
            </div>

    
      
            <!--<p class='welcome-text'>Welcome, [User Name]</p>-->
            <div class='navbar-time'>
              <p class='current-time'></p>
            </div>
            <div class='dropdown'>
            <a class='notification-button'><i class='fas fa-bell'></i></a>
            <div class='dropdown-content notification-dropdown'>
              <p class='notification-menu' ></p>
              
               <a  href='send_msg.php'>send notification</a>
               <a  href='faculty_read_msg.php'>my notification</a>
             </div>
          </div>
          
         
        </nav>
        
      </header>";
}
?>
<head>
<link rel="stylesheet" href="header_tt.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<style>
    .notification-dropdown {
        right: 0; /* Add this to align the dropdown to the right */
    }
</style>

</head>
    <body>
    
  <script src="header_tt.js"></script>
        
    </body>