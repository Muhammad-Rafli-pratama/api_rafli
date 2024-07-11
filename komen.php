<?php
header("Content-Type: application/json");

// Replace these with your actual database credentials
$servername = "localhost";
$username = "mobw7774_user_rafli";
$password = "Rafli13_";
$dbname = "mobw7774_api_rafli";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Get data from request
$data = json_decode(file_get_contents("php://input"), true);
$comment = $data['comment'];

// Prepare SQL statement to insert comment
$sql = "INSERT INTO komen (comment) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $comment);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "Komentar berhasil disimpan"]);
} else {
  echo json_encode(["success" => false, "message" => "Gagal menyimpan komentar: " . $stmt->error]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
