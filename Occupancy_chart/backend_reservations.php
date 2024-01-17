<?php

require_once '_db.php';

$start = $_GET['start'];
$end = $_GET['end'];

$stmt = $db->prepare("SELECT * FROM reservations WHERE 1");
// $stmt->bindParam(':start', $start);
// $stmt->bindParam(':end', $end);
$stmt->execute();
$result = $stmt->fetchAll();

class Event {}
$events = array();

date_default_timezone_set("UTC");
$now = new DateTime("now");
$today = $now->setTime(0, 0, 0);

foreach($result as $row) {
    $e = new Event();
    $e->id = $row['id'];
    $e->text = $row['name'];
    $e->start = $row['start'];
    $e->end = $row['end'];
    $e->resource = $row['room_id'];
    $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
    // additional properties


    // $e->status = $row['status'];
    // $e->login_details_id = $row['login_details_id'];


    $events[] = $e;
}

// header('Content-Type: application/json');
// echo json_encode($events);









// require_once '_db.php';

$start = $_GET['start'];
$end = $_GET['end'];
$date = $_GET['date'];
// $stmt = $db->prepare("SELECT * FROM reservations WHERE 1");
// // $stmt->bindParam(':start', $start);
// // $stmt->bindParam(':end', $end);
// $stmt->execute();
// $result = $stmt->fetchAll();

// class Event {}
// $events = array();

date_default_timezone_set("UTC");
$now = new DateTime("now");
$today = $now->setTime(0, 0, 0);

$fdate = date("Y-m-d", strtotime($date));
// $fdate1 = date("d-m-Y", strtotime($date));
$dayOfWeek = date('l', strtotime($fdate));




$host = "localhost";
$username = "root";
$password = "";
$database = "occuupancy_chart";
$port = 3306;









// foreach($result as $row) {
//     $e = new Event();
//     $e->id = $row['id'];
//     // $e->text = $row['name'];

//     // $datetime =$row['start'];
//     // if ($datetime->format('Y-m-d') === $fdate) {
//     // $dateString = '2023-05-25 09:00:00';
//     // $dateTime1 = new DateTime($row['start']);
    
//     // $dateTime1->modify('2023-05-26');
//     // $dateTime2 = new DateTime($row['end']);
    
//     // $dateTime2->modify('2023-05-26');   
//     // $newDateStart = $dateTime1->format('Y-m-d H:i:s');
//     // $newDateEnd = $dateTime2->format('Y-m-d H:i:s');

//     $e->text =$row['start'];
//     $e->start = $row['start'];
//     $e->end = $row['end'];
//     $e->resource = $row['room_id'];
//     $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
//     // additional properties
//     $e->status = $row['status'];
//     $e->login_details_id = $row['login_details_id'];
//     // $events[] = $e;
//     }

$ind = 1;


try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $query = "
    //     SELECT CONCAT(s.subject_name, ' ', sec.year, 'rd Year', ', ', d.department_name, sec.section) AS subject_details,
    //            t.day, 
    //            TIME_FORMAT(SUBSTRING_INDEX(t.time_slot, '-', 1), '%H:%i:%s') AS start_time,
    //            TIME_FORMAT(SUBSTRING_INDEX(t.time_slot, '-', -1), '%H:%i:%s') AS end_time,
    //            sec.default_room
    //     FROM timetable t
    //     JOIN subjects s ON t.subject_id = s.subject_id
    //     JOIN section sec ON t.section_id = sec.sec_id
    //     JOIN department d ON sec.department_id = d.department_id
    //     WHERE t.day = '$dayOfWeek' AND s.subject_name IS NOT NULL
    //           AND s.subject_name NOT IN ('PE2', 'PE3')
    //     ORDER BY t.section_id ASC;
    // ";
    $query = "
        SELECT CONCAT(s.subject_name, ' ', sec.year, 'rd Year', ', ', d.department_name, sec.section) AS subject_details,
               t.day, 
               TIME_FORMAT(SUBSTRING_INDEX(t.time_slot, '-', 1), '%H:%i:%s') AS start_time,
               TIME_FORMAT(SUBSTRING_INDEX(t.time_slot, '-', -1), '%H:%i:%s') AS end_time,
               sec.default_room
        FROM timetable t
        JOIN subjects s ON t.subject_id = s.subject_id
        JOIN section sec ON t.section_id = sec.sec_id
        JOIN department d ON sec.department_id = d.department_id
        WHERE t.day = '$dayOfWeek' AND s.subject_name LIKE '19CSE311%'
              AND s.subject_name NOT IN ('PE2', 'PE3')
        ORDER BY t.section_id ASC;
    ";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process the query result
    foreach ($result as $row) {
    $e = new Event();
    $e->id = $ind;
    // $e->text = $row['name'];
    
    
    // $e->text = $fdate . ' ' . $row['start_time'];
    // $e->text = date('l', strtotime($fdate));
    $e->text = $row['subject_details'];
    $e->start = $fdate . ' '. $row['start_time'];
    $e->end = $fdate . ' '. $row['end_time'];
    $e->resource = $row['default_room'];
    $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
    // additional properties


    // $e->status = $row['status'];
    // $e->login_details_id = $row['login_details_id'];


    $events[] = $e;
        // $subjectDetails = $row['subject_details'];
        // $day = $row['day'];
        // $startTime = $row['start_time'];
        // $endTime = $row['end_time'];
        // $defaultRoom = $row['default_room'];

        // Do something with the retrieved data
        // For example, you can echo them or store them in variables
        // echo "Subject Details: $subjectDetails<br>";
        // echo "Day: $day<br>";
        // echo "Start Time: $startTime<br>";
        // echo "End Time: $endTime<br>";
        // echo "Default Room: $defaultRoom<br>";
        // echo "<br>";
    $ind +=1;
    }
    $query = "
        SELECT DISTINCT e.elective_name, t.day, e.classroom_id,
        TIME_FORMAT(SUBSTRING_INDEX(t.time_slot, '-', 1), '%H:%i:%s') AS start_time,
        TIME_FORMAT(SUBSTRING_INDEX(t.time_slot, '-', -1), '%H:%i:%s') AS end_time
    FROM timetable t
    JOIN subjects s ON t.subject_id = s.subject_id
    JOIN elective e ON s.subject_name = e.type
    WHERE t.day = '$dayOfWeek'
    AND (s.subject_name = 'PE2' OR s.subject_name = 'PE3');
    ";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process the query result
    foreach ($result as $row) {
    $e = new Event();
    $e->id = $ind;
    $e->text = $row['elective_name'];
    $e->start = '2023-05-26 '. $row['start_time'];
    $e->end = '2023-05-26 '. $row['end_time'];
    $e->resource = $row['classroom_id'];
    $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
    // additional properties


    // $e->status = $row['status'];
    // $e->login_details_id = $row['login_details_id'];


    $events[] = $e;
    $ind +=1;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header('Content-Type: application/json');
echo json_encode($events);




?>
