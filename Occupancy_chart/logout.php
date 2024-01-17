<?php
session_start();

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other appropriate page
header("Location: ../extra/admin_login.php");
exit;
?>
