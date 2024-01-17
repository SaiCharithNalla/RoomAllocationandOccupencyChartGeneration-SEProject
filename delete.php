<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the notification from the database
    $sql_delete = mysqli_query($con, "DELETE FROM message WHERE id='$id'");

    if ($sql_delete) {
        // Notification deleted successfully
        echo "Notification deleted successfully!";
    } else {
        // Failed to delete notification
        echo "Failed to delete notification.";
    }
}

// Redirect back to the read_msg.php page
header("Location: read_msg.php");
exit();
?>
