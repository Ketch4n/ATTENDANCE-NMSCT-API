<?php
include '../../db/database.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// User ID or username (replace with the actual value)
$uid = $con->real_escape_string($_POST['id']);
$date = $con->real_escape_string($_POST['date']);

// SQL query to fetch data for a single user using prepared statements
$sql = "SELECT * FROM dtr WHERE student_id = ? AND date = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $uid, $date);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store the results
$response = array();

// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Fetch the row
    $response = $result->fetch_assoc();

    // Optionally, you can create an array representing a single row
    // $response = array(
    //     'id' => $row['id'],
    //     'student_id' => $row['student_id'],
    //     'estab_id' => $row['estab_id'],
    //     'time_in_am' => $row['time_in_am'],
    //     'time_out_am' => $row['time_out_am'],
    //     'time_in_pm' => $row['time_in_pm'],
    //     'time_out_pm' => $row['time_out_pm'],
    //     'date' => $row['date']
    // );
}

// Close the connection
$stmt->close();
$con->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
