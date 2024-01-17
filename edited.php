<?php
include '_dbconnect.php';
session_start();
$username = $_SESSION['username'];

$query = "SELECT sec_id, section FROM section";
$result = mysqli_query($conn, $query);

$sections = array();
while ($row = mysqli_fetch_assoc($result)) {
    $sections[$row['sec_id']] = $row['section'];
}

if (isset($_POST['submit'])) {
    $sec_id = $_POST['section_id'];

    $query = "SELECT * FROM section WHERE sec_id = '$sec_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            $section = $row['section'];
        } else {
            echo "No section found for the selected ID.";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }

    $query = "SELECT DISTINCT time_slot FROM timetable WHERE section_id = '$sec_id'";
    $result = mysqli_query($conn, $query);

    $timeSlots = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $timeSlots[] = $row['time_slot'];
    }

    $query = "SELECT DISTINCT day FROM timetable WHERE section_id = '$sec_id'";
    $result = mysqli_query($conn, $query);

    $days = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $days[] = $row['day'];
    }

    $query = "SELECT subject_id, subject_name FROM subjects";
    $result = mysqli_query($conn, $query);

    $subjects = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[$row['subject_id']] = $row['subject_name'];
    }

    $query = "SELECT day, time_slot, subject_id FROM timetable WHERE section_id = '$sec_id'";
    $result = mysqli_query($conn, $query);

    $timetable = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $day = $row['day'];
        $timeSlot = $row['time_slot'];
        $subjectId = $row['subject_id'];

        $timetable[$day][$timeSlot] = $subjectId;
    }
}

if (isset($_POST['edit_submit'])) {
    $sectionId = $_POST['section_id'];

    // Process the edited timetable data and update the database
    // Add your code here to handle the form submission and update the timetable data in the database
    // You can retrieve the edited timetable data from the $_POST superglobal array
    // Update the necessary records in the database based on the changes made

    // After successfully updating the timetable, you can redirect to the index.php page or display a success message
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            font-size: 16px;
            width: 80%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: sandybrown;
        }
        td input {
            width: 100%;
        }
        input[type="submit"] {
            width: 200px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Edit Timetable</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="section">Select Section:</label>
        <select id="section" name="section_id">
            <?php foreach ($sections as $secId => $secName): ?>
                <option value="<?php echo $secId; ?>" <?php if (isset($sec_id) && $sec_id == $secId) echo 'selected'; ?>>
                    <?php echo $secName; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit" value="Edit Timetable">
    </form>

    <?php if (isset($timetable)): ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="section_id" value="<?php echo $sec_id; ?>">
            <table>
                <tr>
                    <th>Time Slot \ Day</th>
                    <?php foreach ($days as $day): ?>
                        <th><?php echo $day; ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($timeSlots as $timeSlot): ?>
                    <tr>
                        <td><?php echo $timeSlot; ?></td>
                        <?php foreach ($days as $day): ?>
                            <td>
                                <select name="subject_<?php echo $day . '_' . $timeSlot; ?>">
                                    <?php foreach ($subjects as $subjectId => $subjectName): ?>
                                        <option value="<?php echo $subjectId; ?>"
                                            <?php if (isset($timetable[$day][$timeSlot]) && $timetable[$day][$timeSlot] == $subjectId) echo 'selected'; ?>>
                                            <?php echo $subjectName; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" name="edit_submit" value="Save Changes">
        </form>
    <?php endif; ?>
</body>
</html>
