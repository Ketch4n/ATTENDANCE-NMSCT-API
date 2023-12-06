<?php
include '../../db/database.php';

// Assuming you have a database connection established
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get data from Flutter app
$data = json_decode(file_get_contents('php://input'), true);


    $uid = $data['student_id'];
    $sectId = $data['section_id'];
    $reason = nl2br($data['reason']);
    $date = $data['date'];
    $time = $data['time'];

    // Directly insert into the reference table
    $sqlInsert = "INSERT INTO absent (student_id, section_id, date, time,reason) VALUES (?, ?, ?, ?,?)";
    $stmtInsert = $con->prepare($sqlInsert);
    $stmtInsert->bind_param("sssss", $uid, $sectId, $date, $time, $reason);

    if ($stmtInsert->execute()) {
        // Data inserted successfully
        $response = array('status' => 'Success', 'message' => "Submitted Successfully");
        echo json_encode($response);
        exit(); // Add this line to exit the script after echoing the response
    } else {
        // Error inserting data
        $response = array('status' => 'error', 'message' => "Error filing absent");
        echo json_encode($response);
        exit(); // Add this line to exit the script after echoing the response
    }

}
else {
    // Invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
header('Content-Type: application/json');

// Close the database connection
$con->close();
?>