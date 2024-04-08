<?php
require_once '../connect/server.php';
require_once '../connect/cors.php';
$stmt = $conn->prepare("SELECT * FROM fotos ORDER BY data_hora DESC");
$stmt->execute();
$result = $stmt->get_result();
$fotos = array();
while ($row = $result->fetch_assoc()) {
  $fotos[] = $row;
}
echo json_encode($fotos);
?>
