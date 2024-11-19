<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Carat Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php
// Include database connection
include("db_connection.php");
include('header.php');

$user_id = '';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $query = "SELECT 
    p.*, 
    t.*, 
    e.* 
FROM 
    purchase p
JOIN 
    tickets t ON p.ticket_id = t.ticket_id
JOIN 
    event e ON p.event_id = e.event_id
WHERE 
    p.user_id = $user_id;";


    $result = mysqli_query($conn, $query); //run query

} else {
    echo "No Purchase ID provided.";
}
?>

<body class="app">
    <div style="display: flex; justify-content: center;">
        <div class="event-container" style="margin-top:50px; width:100%">
            <h2>Purchase History</h2>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $index = 0;
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Artist Name</th>
                            <th>Event Name</th>
                            <th>Ticket</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {

                            // Create a DateTime object from the date string
                            $date = new DateTime($row['date']);

                            // Get the day and month separately
                            $dateFormat = $date->format('d F Y'); // Day (e.g., 24)
                    
                            ?>
                            <tr>
                                <td><?php echo $row['artistname'] ?></td>
                                <td><?php echo $row['eventname'] ?></td>
                                <td><?php echo $row['ticketname'] ?> - <?php echo $row['section'] ?> </td>
                                <td><?php echo $row['location'] ?></td>
                                <td><?php echo $dateFormat?></td>
                                <td><a onclick="redirectToPage('receipt.php?purchase_id=<?php echo $row['id']; ?>&mode=view')"><i
                                            style="color: purple" class="fa-solid fa-eye"></i></a></td>
                            </tr>
                        <?php }
            } else { ?>
                        <div>
                            No results
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>