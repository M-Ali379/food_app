<?php
header('Content-Type: application/json');
include 'connect.php';

/*print_r($conn);
exit;*/
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['name']) || !isset($data['phone']) || !isset($data['item'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

$name = $data['name'];
$phone = $data['phone'];
$item = $data['item'];

$sql = "INSERT INTO orders (customer_name, phone, order_item) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => $conn->error]);
    exit;
}

$stmt->bind_param("sss", $name, $phone, $item);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "order_id" => $stmt->insert_id]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}
?>
