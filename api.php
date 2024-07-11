<?php
$servername = "localhost";
$username = "mobw7774_user_rafli";
$password = "Rafli13_";
$dbname = "mobw7774_api_rafli";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM social_media";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

echo json_encode($response);

$conn->close();
?>
