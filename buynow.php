<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Buy Now - Carat Live</title>
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

<body class="app">
    <div class="card" style="margin-top:70px; width:100% ">
        <div class="event-section">
            <img src="<?php echo $event['image']; ?>" alt="logo" width="500" height="300">

            <div class="event-detail">
                <h1><?php echo $event['artistname']; ?>: <?php echo $event['eventname']; ?></h1><br>
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $event['location']; ?></p><br>
                <p><i class="fa-solid fa-calendar-days"></i> <?php echo $event['date']; ?></p><br>
                <p><i class="fa-solid fa-clock"></i> <?php echo $event['time']; ?></p>

            </div>
        </div>
    </div>

    <div class="card" style="margin-top:30px; width:100%">
        <div style="text-align:center;margin-bottom:10px;">
            <h1>Seat Map for the event</h1>
        </div>
        <div style="display:flex; justify-content: center;margin-bottom:30px;">
            <?php if ($event['seatmapimage']) { ?>
                <img src="<?php echo $event['seatmapimage']; ?>" alt="seatmap" width="700" height="500">
            <?php } else { ?>
                <div
                    style="width:700px;height:500px; border: 1px solid gray; border-radius: 15px; display:flex; justify-content: center; align-items: center">
                    No seat map available
                </div>
            <?php } ?>
        </div>

        <hr />
        <div style="display: flex; justify-content: center">
            <h1>Select Your Tickets</h1>
        </div>
        <div class="tickets">
            <div class="ticket-row">
                <span>Ticket Category</span>
                <input type="number" placeholder="Quantity" min="0" max="6">
            </div>
            <div class="ticket-row">
                <span>Ticket Category</span>
                <input type="number" placeholder="Quantity" min="0" max="6">
            </div>
            <div class="ticket-row">
                <span>Ticket Category</span>
                <input type="number" placeholder="Quantity" min="0" max="6">
            </div>
            <div class="ticket-row">
                <span>Ticket Category</span>
                <input type="number" placeholder="Quantity" min="0" max="6">
            </div><br><br>
            <p><em>*Ticket price excludes ticket fee and booking charges</em></p>
        </div>
        <div class="center-button" style="padding-top: 40px">
            <button class="buttonSecondary">Buy Tickets Now</button>
        </div>
    </div>

</body>

</html>