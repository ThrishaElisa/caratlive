<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    // Capture the data from the form
    $eventname = $_POST['eventname'];
    $artistname = $_POST['artistname'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    // Define allowed file types
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    $timeWithSeconds = $time . ":00"; // For example: '14:30:00'


    // Check if the image is of a valid type
    if (in_array($imageType, $allowedTypes)) {
        // Check for upload errors
        if ($imageError === 0) {
            // Set the image upload path
            $imageDestination = 'uploads/' . $imageName;

            // Move the image to the desired directory
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Save the image path in the database
                $imagePath = $imageDestination;

                $sql = "INSERT INTO event (eventname, artistname, date, time, location, description, content, image) 
                        VALUES ('$eventname', '$artistname', '$date', '$timeWithSeconds', '$location', '$description', '$content', '$imagePath')";

                // Execute the query
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('New event created successfully');</script>";
                    header("Location: event.php");
                } else {
                    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
                }

            } else {
                echo "Error moving the file!";
            }
        } else {
            echo "There was an error uploading the file!";
        }
    } else {
        echo "Invalid file type! Only JPG, PNG, and GIF are allowed.";
    }

    // Close the database connection
    $conn->close();
}
?>