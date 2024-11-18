<?php
    session_start();
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the data from the form
    $name= $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
 
    // Initialize the variable to false
    $emailExists = false;

    // Prepare the SQL query to check if the email exists
    $queryemail = "SELECT * FROM user WHERE email = '$email'";

    // Execute the query
    $resultemail = mysqli_query($conn, $queryemail);

    // Check if the query returned any rows
    if (mysqli_num_rows($resultemail) > 0) {
        // Email exists
        $emailExists = true;
    } else {
        // Email doesn't exist
        $emailExists = false;
    }

    $sql = "INSERT INTO inquiry (name, email, message, internaluser) 
            VALUES ('$name', '$email', '$message', '$emailExists')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {    
        $title =  '?title=Success';
        $description = '&description=Inquiry+submitted+successfully';
        $link='&link=event.php';
        $linkdesc= '&linkdesc=Go+to+Events';
        header("Location: template.php".$title.$description.$link.$linkdesc);
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }     
   
    // Close the database connection
    $conn->close();
}
?>