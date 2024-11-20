<?php

include("db_connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstnameH'];
    $lastname = $_POST['lastnameH'];
    $email = $_POST['emailH'];
    $phone = $_POST['phoneH'];
    $address = $_POST['addressH'];
    $ticketname = $_POST['ticketnameH'];
    $ticketNum = $_POST['ticketNumH'];
    $section = $_POST['sectionH'];
    $totalprice = $_POST['totalpriceH'];
    $paymentMethod = $_POST['paymentMethodH'];
    $event_id = $_POST['event_id'];
    $ticket_id = $_POST['ticket_id'];
    $user_id = $_POST['user_id'];


    $sql = "INSERT INTO purchase (firstname, lastname, email, phone, address, ticket_id, event_id, ticketNum, totalprice, paymentMethod, user_id) 
    VALUES ('$firstname', '$lastname', '$email', '$phone','$address', '$ticket_id', '$event_id', '$ticketNum','$totalprice', '$paymentMethod', '$user_id')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
         // Get the last inserted ID
         $last_inserted_id = $conn->insert_id;

        // Update the remaining quantity in the ticket table
        $updateSql = "UPDATE tickets SET remainingquantity = remainingquantity - $ticketNum WHERE ticket_id = '$ticket_id'";
        if ($conn->query($updateSql) === TRUE) {
            $title = '?title=Success';
            $description = '&description=Tickets+secured+successfully!';
            $link = '&link=receipt.php';
            $linkdesc = '&linkdesc=See+Receipt';
            header("Location: template.php" . $title . $description . $link . $linkdesc. "&purchase_id=". $last_inserted_id);
        } else {
            echo "<script>alert('Error updating remaining quantity: " . $updateSql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

}
?>