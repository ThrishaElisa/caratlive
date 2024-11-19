<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>More Info - Carat Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php
// Include database connection
include("db_connection.php");
include('header.php');

// Query to fetch all event
if (isset($_GET['event_id'])) {

    $event_id = $_GET['event_id'];

    $query = "SELECT * FROM event WHERE event_id = $event_id";
    $result = mysqli_query($conn, $query); //run query
    if (mysqli_num_rows($result) > 0) {

        $event = mysqli_fetch_assoc($result);

    } else {
        echo "Event not Found.";
    }
} else {
    echo "No event ID provided.";
}
?>

<?php
// Create a DateTime object from the date string
$date = new DateTime($event['date']);

// Get the day and month separately
$dateFormat = $date->format('d F Y'); // Day (e.g., 24)
?>

<body class="app">
    <div class="card" style="margin-top:70px">
        <h1><?php echo $event['artistname']; ?>: <?php echo $event['eventname']; ?></h1><br>
        <div class="moreinfo-card">
            <img src="<?php echo $event['image']; ?>" alt="poster" width="700" height="400">
            <div style="padding-left: 50px">
                <p><i class="fa-solid fa-location-dot"></i><?php echo $event['location']; ?></p><br>
                <p><i class="fa-solid fa-calendar-days"></i><?php echo $dateFormat ?> </p>
                </p><br>
                <p><i class="fa-solid fa-clock"></i><?php echo date("h:i A", strtotime($event['time'])); ?></p><br>
                <p><?php echo $event['description']; ?></p>
                <div style="padding-top: 40px">
                    <a href="buynow.php?event_id=<?php echo $event_id; ?>">
                        <button id="buy-button" class="buttonSecondary">Buy Tickets Now</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="moreinfo-card" style="margin-top: 30px; padding: 40px">
            <div class="ck-content">
                <?php echo $event['content']; ?>
            </div>

        </div>
    </div>

    <script>
        if (!user) {
            document.getElementById('buy-button').style.display = 'none'; //make it disappear
        } 
    </script>
</body>

</html>