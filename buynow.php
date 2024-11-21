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

        $queryTicket = "SELECT ticket_id, ticketname, ticketprice, ticketquantity, section, event_id, remainingquantity FROM tickets WHERE event_id = ?";
        $stmtTicket = $conn->prepare($queryTicket);


        $stmtTicket->bind_param("i", $event_id);

        // Execute the query
        $stmtTicket->execute();
        $resultTicket = $stmtTicket->get_result();

        // Fetch all results into a structured array
        $data = [];
        while ($row = $resultTicket->fetch_assoc()) {
            $data[] = [
                "ticket_id" => $row['ticket_id'],
                "ticketname" => $row['ticketname'],
                "ticketprice" => $row['ticketprice'],
                "ticketquantity" => $row['ticketquantity'],
                "section" => $row['section'],
                "event_id" => $row['event_id'],
                "remainingquantity" => $row['remainingquantity']
            ];
        }
        $groupedTickets = [];
        foreach ($data as $ticket) {
            if ($ticket['remainingquantity'] >= 1) {
                $groupedTickets[$ticket['ticketname']][] = $ticket;
            }
        }

    } else {
        echo "Event not Found.";
    }
} else {
    echo "No event ID provided.";
}

// Create a DateTime object from the date string
$date = new DateTime($event['date']);

// Get the day and month separately
$dateFormat = $date->format('d F Y'); // Day (e.g., 24)
?>

<body class="app">
    <div class="card" style="margin-top:70px; width:100% ">
        <div class="event-section">
            <img src="<?php echo $event['image']; ?>" alt="logo" width="500" height="300">

            <div class="event-detail">
                <h1><?php echo $event['artistname']; ?>: <?php echo $event['eventname']; ?></h1><br>
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $event['location']; ?></p><br>
                <p><i class="fa-solid fa-calendar-days"></i> <?php echo $dateFormat ?></p><br>
                <p><i class="fa-solid fa-clock"></i><?php echo date("h:i A", strtotime($event['time'])); ?></p>

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

            <div style="margin-left:20px; display: flex; align-items: center;">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $index = 0;
                    ?>
                    <table>

                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Seats Available</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Output data of each row
                            foreach ($data as $ticket) {
                                ?>
                                <tr>
                                    <td><?php echo $ticket['section'] ?></td>
                                    <td><?php echo $ticket['ticketname'] ?></td>
                                    <td>RM <?php echo $ticket['ticketprice'] ?></td>
                                    <td
                                        style="<?php echo $ticket['remainingquantity'] === 0 ? 'color: red' : 'color: green'; ?>">
                                        <?php echo $ticket['remainingquantity'] ?>
                                    </td>


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

        <hr />
        <div style="display: flex; justify-content: center">
            <h1>Select Your Tickets</h1>
        </div>

        <div class="tickets">
            <p><em>*Ticket price excludes ticket fee and booking charges</em></p>
            <?php
            if (count($groupedTickets) > 0) {

                ?>

                <div class="ticket-row">
                    <select id="ticketname" name="ticketname" style="width:50%" onchange="updateSections()">
                        <option value="">Select Category</option>
                        <?php
                        foreach ($groupedTickets as $ticketname => $tickets) {
                            ?>
                            <option value="<?php echo htmlspecialchars($ticketname); ?>">
                                <?php echo htmlspecialchars($ticketname); ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <!-- Section Dropdown -->
                    <select id="section" name="section" style="width:30%" onchange="getAvailableSeats()">
                        <option value="">Select Section</option>
                    </select>
                    <select id="ticketNum" name="ticketNum">
                        <option value="">Select Quantity</option>
                    </select>

                </div>
                <?php

            } else {
                ?>
                <div style="padding:16px 0px 16px 0px;">
                    No categories available
                </div>
                <?php
            }
            ?>

        </div>
        <?php
        if (count($groupedTickets) > 0) {
            ?>
            <div class="center-button" style="padding-top: 40px">
                <button class="buttonSecondary" onclick="proceedToPayment()">Proceed to Payment</button>
            </div>
        <?php }
        ?>
    </div>

    <script>
        if ((<?php echo json_encode($groupedTickets); ?>).length > 0) {
            localStorage.setItem('purchase', null)
            document.getElementById('ticketname').value = ''
            document.getElementById('ticketNum').value = ''
            document.getElementById('section').value = ''
        }

        function updateSections() {
            var ticketname = document.getElementById('ticketname').value;
            var sectionDropdown = document.getElementById('section');

            // Clear previous section options
            sectionDropdown.innerHTML = '<option value="">Select Section</option>';

            // Check if a ticketname is selected
            if (ticketname !== "") {
                // Define the sections available for each ticketname
                var ticketSections = <?php echo json_encode($groupedTickets); ?>;

                // Get the sections for the selected ticketname
                var sections = ticketSections[ticketname] || [];

                // Add sections as options to the section dropdown
                sections.forEach(function (ticket) {
                    var option = document.createElement("option");
                    option.value = ticket.section;
                    option.textContent = ticket.section;
                    sectionDropdown.appendChild(option);
                });
            }
            getAvailableSeats();
        }

        function getAvailableSeats() {
            var section = document.getElementById('section').value;
            var ticketname = document.getElementById('ticketname').value;
            var ticketNumDropdown = document.getElementById('ticketNum');

            // Clear previous section options
            ticketNumDropdown.innerHTML = '<option value="">Select Quantity</option>';
            if (section !== "") {
                var tickets = <?php echo json_encode($data); ?>;
                let ticketSelected = tickets.find(ticket => ticket.section === section && ticket.ticketname === ticketname);
                for (let i = 1; i < 4; i++) {
                    if (i <= ticketSelected.remainingquantity) {
                        var option = document.createElement("option");
                        option.value = i;
                        option.textContent = i;
                        ticketNumDropdown.appendChild(option);
                    }
                }

            }
        }

        function proceedToPayment() {
            let ticketname = document.getElementById('ticketname').value;
            let ticketNum = document.getElementById('ticketNum').value;
            let section = document.getElementById('section').value;
            if (ticketNum && ticketname && ticketNum > 0 && section) {
                var data = <?php echo json_encode(value: $data); ?>;

                let ticket = data.find(ticket => ticket.section === section && ticket.ticketname === ticketname);
                if (ticketNum <= ticket.remainingquantity) {

                    localStorage.setItem('purchase', JSON.stringify({
                        ticketname,
                        ticketNum,
                        section,
                        pricePerTicket: ticket.ticketprice,
                        ticket_id: ticket.ticket_id

                    }))
                    window.location.href = "customerdetails.php?event_id=<?php echo $event_id; ?>";
                } else {
                    alert("Seats are not available.")
                }

            } else {
                alert("Please choose ticket that you would like to purchase")
            }

        }
    </script>

</body>

</html>