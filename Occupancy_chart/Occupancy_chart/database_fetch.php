<?php
require_once '_db.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$id = isset($params->id) ? $params->id : 1;

$stmt = $db->prepare("SELECT status FROM rooms WHERE id = :id ");
$stmt->bindParam(':id', $id); 
$stmt->execute();
$status = $stmt->fetchColumn();

$result = array('status' => $status);

header('Content-Type: application/json');
echo json_encode($result);
