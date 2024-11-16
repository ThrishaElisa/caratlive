<?php
// Include the database connection
include 'db_connection.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];


    // Check for upload errors    

    $sql = "DELETE FROM event WHERE event_id = $event_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect with an alert
        echo "<script>
                alert('Event deleted successfully');
                window.location.href = 'event.php'; // Redirect to event list after success
              </script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    } 

    // Close the database connection
    $conn->close();
}
?>
