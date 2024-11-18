<?php
// Include the database connection
include 'db_connection.php';

// Check if form data is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reply = $_POST['reply'];
    $inquiry_id = $_POST['inquiry_id'];
 

    $sql = "UPDATE inquiry SET reply = '$reply' WHERE id = '$inquiry_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {    
        $title =  '?title=Success';
        $description = '&description=Reply+submitted+successfully';
        $link='&link=inquiries.php';
        $linkdesc= '&linkdesc=Go+to+Inquiries+List';
        header("Location: template.php".$title.$description.$link.$linkdesc);
    } else {
        $title =  '?title=Error';
        $description = '&description=Reply+did not+submitted+successfully';
        $link='&link=inquiries.php';
        $linkdesc= '&linkdesc=Go+to+Inquiries+List';
        header("Location: template.php".$title.$description.$link.$linkdesc);
    }     



    // Close the database connection
    $conn->close();
}
?>