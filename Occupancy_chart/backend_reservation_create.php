<?php
require_once '_db.php';

session_start(); // Start the session

$json = file_get_contents('php://input');
$params = json_decode($json);

$stmt = $db->prepare("INSERT INTO reservations (name, start, end, room_id, status, login_details_id) VALUES (:name, :start, :end, :room, 'New', :login_details_id)");
$stmt->bindParam(':start', $params->start);
$stmt->bindParam(':end', $params->end);
$stmt->bindParam(':name', $params->text);
$stmt->bindParam(':room', $params->resource);
$stmt->bindParam(':login_details_id', $_SESSION["loggedin"]); // Add login_details_id from $_SESSION["loggedin"]
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();

$response->id = $db->lastInsertId();
$response->status = "New";

header('Content-Type: application/json');
echo json_encode($response);
?>
