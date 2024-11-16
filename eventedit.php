<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the data from the form
    $eventname= $_POST['eventname'];
    $artistname = $_POST['artistname'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $event_id = $_POST['event_id'];

    $timeWithSeconds = $time . ":00"; // For example: '14:30:00'

    // Check for upload errors    

    $sql = "UPDATE event SET eventname = '$eventname', artistname = '$artistname', date = '$date', time = '$timeWithSeconds', location = '$location', description = '$description', content = '$content' WHERE event_id = '$event_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>        
        window.location.href = 'event.php'; // Redirect to event list after success
        alert('Event updated successfully');
        </script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    } 

    // Close the database connection
    $conn->close();
}
?>
