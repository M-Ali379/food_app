<?php
include 'connect.php';

$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);

$order = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $order[] = $row;
    }
    echo json_encode($order);
} else {
    echo json_encode(['error' => $conn->error]);
}
?>
