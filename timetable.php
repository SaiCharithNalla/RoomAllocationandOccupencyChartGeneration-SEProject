<?php
include '_dbconnect.php';
session_start();
$username = $_SESSION['username'];


$sql = "SELECT section_id FROM student WHERE student_id = '$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $sec_id = $row['section_id'];
} else {
  echo "Query failed: " . mysqli_error($conn);
}

$sql = "SELECT default_room FROM section WHERE sec_id = '$sec_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $default_room = $row['default_room'];
} else {
  echo "Query failed: " . mysqli_error($conn);
}

//echo $default_room;

$sql = "SELECT * FROM rooms WHERE id = '$default_room'";
$result1 = mysqli_query($conn, $sql);
if ($result1) {
  $row = mysqli_fetch_assoc($result1);
  $classroom = $row['name'];
} else {
  echo "Query failed: " . mysqli_error($conn);
}





$sql = "SELECT * FROM section WHERE sec_id = '$sec_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $year = $row['year'];
  $department_id = $row['department_id'];
  $section = $row['section'];
  $room = $row['default_room'];
} else {
  echo "Query failed: " . mysqli_error($conn);
}

$sql = "SELECT * FROM department WHERE department_id = '$department_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $department_id = $row['department_id'];
  $department_name = $row['department_name'];
  //echo $department_name;
} else {
  echo "Query failed: " . mysqli_error($conn);
}





$query = "SELECT DISTINCT time_slot FROM timetable";
$result = mysqli_query($conn, $query);

$timeSlots = array();
while ($row = mysqli_fetch_assoc($result)) {
    $timeSlots[] = $row['time_slot'];
}



$query = "SELECT DISTINCT day FROM timetable";
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
//echo $sec_id;
$timetable = array();
while ($row = mysqli_fetch_assoc($result)) {
    $day = $row['day'];
    $timeSlot = $row['time_slot'];
    $subjectId = $row['subject_id'];
    
    
    $timetable[$day][$timeSlot] = $subjects[$subjectId];
}



$query = "SELECT PE2, PE3 FROM student WHERE student_id = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $pe2Course = $row['PE2'];
  $pe3Course = $row['PE3'];
} else {
  echo "Query failed: " . mysqli_error($conn);
}

foreach ($timetable as $day => &$slots) {
    foreach ($slots as $timeSlot => &$slot) {
        if ($slot == 'PE2') {
            $slot = $pe2Course;
        } elseif ($slot == 'PE3') {
            $slot = $pe3Course;
        }
    }
}




$query = "SELECT * FROM elective WHERE elective_name = '$pe2Course'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $pe2room = $row['classroom_id'];
  } else {
    echo "Query failed: " . mysqli_error($conn);
  }
//echo $pe2room;


$query = "SELECT * FROM elective WHERE elective_name = '$pe3Course'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $pe3room = $row['classroom_id'];
  } else {
    echo "Query failed: " . mysqli_error($conn);
  }
//echo $pe3room;


$sql = "SELECT * FROM rooms WHERE id = '$pe2room'";
$result1 = mysqli_query($conn, $sql);
if ($result1) {
  $row = mysqli_fetch_assoc($result1);
  $pe2room = $row['name'];
} else {
  echo "Query failed: " . mysqli_error($conn);
}

$sql = "SELECT * FROM rooms WHERE id = '$pe3room'";
$result1 = mysqli_query($conn, $sql);
if ($result1) {
  $row = mysqli_fetch_assoc($result1);
  $pe3room = $row['name'];
} else {
  echo "Query failed: " . mysqli_error($conn);
}
?>



<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
            margin: 0;
            padding: 0;
        }
  
  .header {
    width: 100%;
  }
  
  .logo {
    margin: 0 auto;
    text-align: center;
  }
  
  .navbar-right {
    margin-left: auto;
  }
  
  .welcome-text {
    margin-right: 10px;
  }
  
  .navbar-time {
    margin-right: 10px;
  }
  
  .notification-button {
    margin-right: 10px;
  }
  
  .navbar-toggle {
    display: none;
  }
  
  @media screen and (max-width: 778px) {
    .navbar-menu {
      position: static;
      width: 100%;
      background-color: rgba(155, 238, 255, 0.963);
    }
    
    .navbar-menu li {
      display: inline-block;
      margin: 10px;
    }
    
    .navbar-toggle {
      display: block;
    }
    
    .navbar-menu.active {
      display: block;
    }
  }

        table {
            border-collapse: collapse;
            font-size: 16px;
            width: 80%;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color:sandybrown ;
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
<br>
<br>
<br>
<br>
<br>


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
                <?php
                    $prevSubject = null;
                    foreach ($timeSlots as $timeSlot): ?>
                    <?php $subject = isset($timetable[$day][$timeSlot]) ? $timetable[$day][$timeSlot] : "";

                    if (!empty($subject)):
                        ?>
                        <?php if ($subject == $pe2Course): ?>
                            <td class="course-cell yellow"><?php echo $subject; ?><br><span class="classroom-cell">Classroom: <?php echo $pe2room; ?></span></td>
                        <?php elseif ($subject == $pe3Course): ?>
                            <td class="course-cell green"><?php echo $subject; ?><br><span class="classroom-cell">Classroom: <?php echo $pe3room; ?></span></td>
                        <?php elseif ($subject == "19SSK311"): ?>
                            <td class="course-cell light-blue"><?php echo $subject; ?><br><span class="classroom-cell">Classroom: <?php echo $classroom; ?></span></td>
                        <?php else: ?>
                            <td class="course-cell"><?php echo $subject; ?><br><span class="classroom-cell">Classroom: <?php echo $classroom; ?></span></td>
                        <?php endif; ?>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>


