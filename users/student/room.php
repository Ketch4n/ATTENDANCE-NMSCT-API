<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$estabId = 5;

// SQL query to fetch data for a single user with left joins and filtering for null values
$sql = "SELECT room.*, establishment.*, users.*,
  COALESCE(admin.name,admin.name) AS creator_name,
  COALESCE(admin.email,admin.email) AS creator_email

        FROM room
        INNER JOIN establishment ON room.establishment_id = establishment.id
        INNER JOIN admin ON admin.id = establishment.creator_id
        LEFT JOIN users ON room.student_id = users.id
        WHERE room.establishment_id = $estabId";



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

// Close the connection
$con->close();

// Return the JSON response without brackets
header('Content-Type: application/json');
echo json_encode($response);
