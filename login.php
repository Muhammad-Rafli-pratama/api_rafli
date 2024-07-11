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
$username = $data['username'];
$password = $data['password'];

// Prepare SQL statement to check user credentials
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
  if (password_verify($password, $user['password'])) {
    echo json_encode(["success" => true, "message" => "Login successful"]);
  } else {
    echo json_encode(["success" => false, "message" => "Invalid credentials"]);
  }
} else {
  echo json_encode(["success" => false, "message" => "User not found"]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>