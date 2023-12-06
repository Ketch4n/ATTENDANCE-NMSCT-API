<?php
include '../../db/database.php';

header('Content-Type: application/json');

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Sanitize user input
$uid = $con->real_escape_string($_POST['student_id']);
$sectId = $con->real_escape_string($_POST['section_id']);

// SQL query to fetch data for a single user using prepared statements
$sql = "SELECT * FROM absent WHERE student_id = ? AND section_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $uid, $sectId);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store the results
$response = array();

// Error handling for the query execution
if (!$result) {
    $response = array('status' => 'error', 'message' => 'Query failed');
    echo json_encode($response);
    exit();
}

// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Loop through the result set and fetch all rows
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

// Close the database connection
$stmt->close();
$con->close();

// Return the JSON response
echo json_encode($response);
?>
