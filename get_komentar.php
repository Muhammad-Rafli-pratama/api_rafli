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

// Prepare SQL statement to fetch comments
$sql = "SELECT comment FROM komen";
$result = $conn->query($sql);

$comments = [];
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $comments[] = $row;
  }
}

echo json_encode($comments);

// Close connection
$conn->close();
?>
