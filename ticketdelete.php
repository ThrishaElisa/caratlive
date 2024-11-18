<?php
// Include the database connection
include 'db_connection.php';

if (isset($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];
    $event_id = $_GET['event_id'];


    // Check for upload errors    

    $sql = "DELETE FROM tickets WHERE ticket_id = $ticket_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect with an alert
        header("Location: manageticketform.php?event_id=".$event_id);
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    } 

    // Close the database connection
    $conn->close();
}
?>
