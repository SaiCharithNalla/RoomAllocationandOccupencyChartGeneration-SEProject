<?php
include '_dbconnect.php';

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
        td {
            background-color: #ffffff;
        }
        .course-cell {
            font-weight: bold;
        }
        .classroom-cell {
            font-style: italic;
            font-size: 14px;
        }
        /* Define colors for different subjects and session types */
        .yellow {
            background-color: yellow;
            color: black;
        }
        .green {
            background-color: chartreuse;
            color: black;
        }
        .light-blue {
            background-color: aqua;
            color: black;
        }
    </style>
</head>
<body>
    <?php include 'headerrr.php'; ?>

    <form method="post">
        <label for="section_id">Select Section:</label>
        <select name="section_id" id="section_id">
            <?php foreach ($sections as $secId => $secName): ?>
                <option value="<?php echo $secId; ?>" <?php if (isset($sec_id) && $secId == $sec_id) echo 'selected'; ?>><?php echo $secName; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" name="submit" value="Show Timetable">
    </form>

    <?php if (isset($_POST['submit']) || isset($timetable)): ?>
        <table>
            <tr>
                <th></th>
                <?php foreach ($timeSlots as $timeSlot): ?>
                    <th><?php echo $timeSlot; ?></th>
                <?php endforeach; ?>
            </tr>

            <?php foreach ($days as $day): ?>
                <tr>
                    <th><?php echo $day; ?></th>
                    <?php foreach ($timeSlots as $timeSlot): ?>
                        <?php
                            $subjectId = $timetable[$day][$timeSlot] ?? "";
                            $subjectName = $subjects[$subjectId] ?? "";

                            // Assign CSS class based on subject ID
                            $class = "";
                            if ($subjectId == 6) {
                                $class = "yellow";
                            } elseif ($subjectId == 7) {
                                $class = "green";
                            } elseif ($subjectId == 5) {
                                $class = "light-blue";
                            }
                        ?>
                        <td class="<?php echo $class; ?>"><?php echo $subjectName; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>