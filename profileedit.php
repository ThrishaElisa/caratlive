<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the data from the form
    $firstname= $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $user_id = $_POST['user_id'];
     

    // Check for upload errors    

    $sql = "UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email', phonenumber = '$phonenumber',  address = '$address' WHERE id = '$user_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $title =  '?title=Success';
        $description = '&description=Profile+updated+successfully';
        $link='&link=profileform.php?user_id='.$user_id ;
        $linkdesc= '&linkdesc=Go+to+profile';
        header("Location: template.php".$title.$description.$link.$linkdesc);
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    } 

    // Close the database connection
    $conn->close();
}
?>