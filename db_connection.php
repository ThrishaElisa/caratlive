<?php
// Database connection parameters
$servername = "localhost";
$username = "root";  // Default username for local development
$password = "";      // Default password for local development
$dbname = "carat_live"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>