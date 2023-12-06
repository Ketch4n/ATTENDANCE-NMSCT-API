<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$date = $_POST['date'];   // Sanitize user input
$sectId = $_POST['section_id'];

// SQL query to fetch data and merge results with the same date and email
$sql = "SELECT date, email, MAX(time) AS max_time, date, email
        FROM accomplishment 
        WHERE section_id = '$sectId' AND date = '$date'
        GROUP BY date, email
        ORDER BY max_time DESC";

// Execute the query
$result = $con->query($sql);

// Initialize an empty array to store the results
$response = array();

if (!$result) {
    // Handle the query error
    die("Query failed: " . $con->error);
}

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