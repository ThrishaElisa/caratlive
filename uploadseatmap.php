<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    // Capture the data from the form
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    $event_id = $_POST['event_id'];

    // Define allowed file types
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

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

                $sql = "UPDATE event SET seatmapimage = '$imagePath' WHERE event_id = '$event_id'";


                // Execute the query
                if ($conn->query($sql) === TRUE) {
                    header("Location: manageticketform.php?event_id=".$event_id);
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
}
?>
