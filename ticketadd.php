<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the data from the form
    $ticketname= $_POST['ticketname'];
    $ticketprice = $_POST['ticketprice'];
    $ticketquantity = $_POST['ticketquantity'];
    $section = $_POST['section'];
    $event_id = $_POST['event_id'];

    $sql = "INSERT INTO tickets (ticketname, ticketprice, ticketquantity, section, event_id, remainingquantity) 
            VALUES ('$ticketname', '$ticketprice', '$ticketquantity', '$section', '$event_id', $ticketquantity)";

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