<?php
include '_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $timeSlot = $_POST['timeSlot'];
    $subjectId = $_POST['subjectId'];

    $query = "UPDATE timetable SET subject_id = '$subjectId' WHERE day = '$day' AND time_slot = '$timeSlot'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Subject updated successfully.";
    } else {
        echo "Failed to update subject: " . mysqli_error($conn);
    }
}
?>
