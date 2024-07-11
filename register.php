<?php
header('Content-Type: application/json');
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $input = json_decode(file_get_contents('php://input'), true);
  $username = $input['username'];
  $password = $input['password'];

  // Replace these with your actual database credentials
  $servername = "localhost";
  $dbusername = "mobw7774_user_rafli";
  $dbpassword = "Rafli13_";
  $dbname = "mobw7774_api_rafli";

  // Create connection
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
    $response['success'] = false;
    $response['message'] = "Database connection failed: " . $conn->connect_error;
  } else {
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt->bind_param("ss", $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
      $response['success'] = true;
      $response['message'] = "User registered successfully";
    } else {
      $response['success'] = false;
      $response['message'] = "Registration failed: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
  }
} else {
  $response['success'] = false;
  $response['message'] = "Invalid request method";
}

echo json_encode($response);
?>
