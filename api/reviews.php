<?php
header('Content-Type: application/json');

// DB Connection
$conn = new mysqli("localhost", "root", "", "food_app", 3307);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

// Handle POST (Save Review)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['name'], $data['item'], $data['text'], $data['time'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing fields"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO reviews (name, item, text, time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data['name'], $data['item'], $data['text'], $data['time']);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Insert failed: " . $stmt->error]);
    }

    $stmt->close();
    exit;
}

// Handle GET (Fetch All Reviews)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT name, item, text, time FROM reviews ORDER BY id DESC");

    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

    echo json_encode($reviews);
    exit;
}

// Invalid request
http_response_code(405);
echo json_encode(["error" => "Method not allowed."]);
