<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$email = "mangao.christian.04@gmail.com";
// $sid = $_POST['section_id'];
$date = "2023-11-15"; // Enclosed in single quotes and treated as a string

// SQL query to fetch data for a single user
$sql = "SELECT * FROM accomplishment WHERE email = '$email' AND date = '$date'";

// Execute the query
$result = $con->query($sql);

// Initialize an empty array to store the results
$response = array();

if ($result->num_rows > 0) {
    // Loop through the result set and fetch all rows
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
