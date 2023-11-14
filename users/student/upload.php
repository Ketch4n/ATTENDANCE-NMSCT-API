<?php
include '../../db/database.php';

// Assuming you have a database connection established

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    $email = $data['email'];
    $section = $data['section'];
    $comment = nl2br($data['comment']);
    $date = $data['date'];

    // Directly insert into the reference table
    $sqlInsert = "INSERT INTO accomplishment (email, section_id, comment, date) VALUES (?, ?, ?, ?)";
    $stmtInsert = $con->prepare($sqlInsert);
    $stmtInsert->bind_param("ssss", $email, $section, $comment, $date);

    if ($stmtInsert->execute()) {
        // Data inserted successfully
        $response = array('status' => 'Success', 'message' => "Accomplishment added successfully");
        echo json_encode($response);
        exit(); // Add this line to exit the script after echoing the response
    } else {
        // Error inserting data
        $response = array('status' => 'error', 'message' => "Error adding accomplishment");
        echo json_encode($response);
        exit(); // Add this line to exit the script after echoing the response
    }
} else {
    // Invalid request method
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
    exit(); // Add this line to exit the script after echoing the response
}

header('Content-Type: application/json');

// Close the database connection
$con->close();
?>
