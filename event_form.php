<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Event Form - Carat Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Include CKEditor script from CDN -->
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
</head>

<?php
// Include database connection
include("db_connection.php");
include('header.php');

$event_id = '';
$mode = '';

if (isset($_GET['event_id']) && isset($_GET['mode']) == 'edit') {
	htmlspecialchars($_GET['event_id']);
    $event_id = $_GET['event_id'];
    $mode = $_GET['mode'];
    
   
    $eventname= '';
    $artistname = '';
    $date = '';
    $time = '';
    $location = '';
    $description = '';
    $content = '';
    $image = '';

    // Prepare a parameterized query
    $query = "SELECT * FROM event WHERE event_id = $event_id";
    $result = mysqli_query($conn, $query);


	if(mysqli_num_rows($result) > 0){

		$event = mysqli_fetch_assoc($result);
        $eventname= $event['eventname'];
        $artistname = $event['artistname'];
        $date = $event['date'];
        $time = $event['time'];
        $location = $event['location'];
        $description = $event['description'];
        $content = $event['content'];
        $image = $event['image'];

	} else{
		echo "Event not Found.";
	}

} 
?>

<body class="app">
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="admin-container" style="width: 700px; background: whitesmoke">
            <h2>Enter Event Details</h2>
            <form action="<?php echo ($mode == 'edit') ? 'eventedit.php' : 'eventadd.php'; ?>" method="POST"
                onsubmit="return validateEventForm(event)" enctype="multipart/form-data">
                <?php if ($mode != 'edit'){ 
                ?>
                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif">
                </div>
                <?php } else {
                ?>
                <!-- Hidden field to pass event_id -->
                <input type="hidden" name="event_id" value="<?php echo isset($event_id) ? $event_id : ''; ?>">
                <?php }
                ?>

                <div class="form-group">
                    <label for="eventname">Event Name:</label>
                    <input type="text" id="eventname" name="eventname"
                        <?php echo !empty($eventname) ? 'value="' . htmlspecialchars($eventname) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="artistname">Artist Name:</label>
                    <input type="text" id="artistname" name="artistname"
                        <?php echo !empty($artistname) ? 'value="' . htmlspecialchars($artistname) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date"
                        <?php echo !empty($date) ? 'value="' . htmlspecialchars($date) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time"
                        <?php echo !empty($time) ? 'value="' . htmlspecialchars($time) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location"
                        <?php echo !empty($location) ? 'value="' . htmlspecialchars($location) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="description">Events Description:</label>
                    <textarea id="description" name="description"
                        rows="5"><?php echo !empty($location) ? htmlspecialchars($description) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Event Content:</label>
                    <textarea id="content" name="content"
                        rows="5"><?php echo !empty($location) ? htmlspecialchars($content) : ''; ?></textarea>
                </div>
                <div style="text-align: center;">
                    <button class="buttonSecondary" onclick="redirectToPage('event.php')">
                        Back
                    </button>
                    <button class="buttonSecondary">
                        <?php echo !empty($event_id) ? 'Update' : 'Submit'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Embedding the footer -->
    <div id="footer">
        <iframe src="footer.html" style="border: none; width: 100%;"></iframe>
    </div>

    <script>
    CKEDITOR.replace('content');

    // Function to validate the form (you can also add basic client-side validation here)
    function validateEventForm(event) {

        var eventname = document.getElementById("eventname").value;
        var artistname = document.getElementById("artistname").value;
        var date = document.getElementById("date").value;
        var time = document.getElementById("time").value;
        var location = document.getElementById("location").value;
        var description = document.getElementById("description").value;
        var content = CKEDITOR.instances.content.getData()
        var image = document.getElementById("image").value;

        // Make sure both fields are filled
        if (!eventname || !artistname || !date || !time || !location || !description || !content || !image) {
            alert("Please fill in all fields.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
    </script>

    <?php
// Start the session to check for error message
session_start();

// If there's an error message in session, show an alert
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Clear the error after displaying
}
?>
</body>
</html>