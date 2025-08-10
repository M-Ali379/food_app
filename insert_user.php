<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "food_app", 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is sent
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "✅ User added successfully!";
    } else {
        echo "❌ Error inserting user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Form data not received correctly.";
}

$conn->close();
?>
