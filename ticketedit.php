<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketname= $_POST['ticketname'];
    $ticketprice = $_POST['ticketprice'];
    $ticketquantity = $_POST['ticketquantity'];
    $section = $_POST['section'];
    $event_id = $_POST['event_id'];
    $ticket_id = $_POST['ticket_id'];

    

    $sql = "UPDATE tickets SET ticketname = '$ticketname', ticketprice = '$ticketprice', ticketquantity = '$ticketquantity', section = '$section' WHERE ticket_id = '$ticket_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: manageticketform.php?event_id=".$event_id);
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    } 

    // Close the database connection
    $conn->close();
}
?>
