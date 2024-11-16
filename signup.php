<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the data from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];

    // Hash the password before inserting it into the database for security
    

    // SQL query to insert data into the user table
    $sql = "INSERT INTO user (firstname, lastname, email, password, birthdate) 
            VALUES ('$firstname', '$lastname', '$email', '$password', '$birthdate')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New user created successfully. Please Log In using your registerd email and password');</script>";
        header("Location: loginform.php");
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>