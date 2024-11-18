<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Buy Now - Carat Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php include('header.php'); ?>

<body class="app">
    <div class="card" style="margin-top:70px; width:100% ">
        <div class="event-section">
            <img src="assets/keshi.png" alt="Keshi Requiem Tour Kuala Lumpur" width="500" height="300">

            <div class="event-detail">
                <h1>Keshi: REQUIEM TOUR IN KUALA LUMPUR</h1><br>
                <p><i class="fa-solid fa-location-dot"></i> Axiata Arena, Bukit Jalil</p><br>
                <p><i class="fa-solid fa-calendar-days"></i> 24 February, Monday</p><br>
                <p><i class="fa-solid fa-clock"></i> 8 PM</p>

            </div>
        </div>
    </div>
    <div class="card" style="margin-top:30px; width:100%">
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