<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Receipt - Carat live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

</head>
<?php
include('header.php');
include 'db_connection.php';

// Query to fetch all event
if (isset($_GET['purchase_id'])) {

    $purchase_id = $_GET['purchase_id'];

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
    p.id = $purchase_id;";
    $result = mysqli_query($conn, $query); //run query
    
    if (mysqli_num_rows($result) > 0) {

        $purchase = mysqli_fetch_assoc($result);

    } else {
        echo "Purchase not Found.";
    }
} else {
    echo "No Purchase ID provided.";
}

// Create a DateTime object from the date string
$date = new DateTime($purchase['date']);

// Get the day and month separately
$dateFormat = $date->format('d F Y'); // Day (e.g., 24)
?>


<body class="app">
    <div class="receipt-container" style="margin-top: 20px">
        <h1>Receipt </h1>
        <p class="receipt-info">
            <strong>Name: </strong>
            <span id="name"><?php echo $purchase['firstname']; ?> <?php echo $purchase['lastname']; ?> </span><br>
            <strong>Phone Number:</strong> <span id="phone-no"><?php echo $purchase['phone']; ?></span><br>
            <strong>Address:</strong> <?php echo $purchase['address']; ?><br>
        </p>

        <hr>
        <p class="receipt-info">
            <strong>Event Name:</strong> <?php echo $purchase['artistname']; ?> -
            <?php echo $purchase['eventname']; ?><br>
            <strong>Location:</strong> <?php echo $purchase['location']; ?><br>
            <strong>Date: </strong> <?php echo $dateFormat ?><br>
            <strong>Time:</strong><?php echo date("h:i A", strtotime($purchase['time'])); ?><br>
        </p>

        <hr>

        <div class="receipt-content">
            <table class="receipt-table" style="margin-top: 40px">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price per Ticket (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $purchase['ticketname']; ?></td>
                        <td><?php echo $purchase['ticketNum']; ?></td>
                        <td><?php echo $purchase['ticketprice']; ?></td>
                    </tr>
                   
                </tbody>
            </table>

            <div class="qr-container">
                <div id="qrcode"></div>
                <p>Show the QR code to redeem your ticket</p>
            </div>
        </div>

        <hr>

        <p class="receipt-total">
            Subtotal: RM <?php echo $purchase['ticketprice'] * $purchase['ticketNum']; ?><br>
            Fees:<span id="tax"><?php echo $purchase['ticketNum']; ?> x RM 20 </span><br>
            <strong>Total Price:</strong><?php echo $purchase['totalprice']; ?>
        </p>

        <p class="receipt-footer">Thank you for your purchase!</p>
    </div>

    <script>
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "You can enter now!!! Enjoy the Concert <3",
            width: 128,
            height: 128,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    </script>
</body>

</html>