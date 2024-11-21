<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Ticket - Carat Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    .form-group-col {
        display: flex;
        flex-direction: column;
        flex: 1 1 calc(50% - 15px);
    }

    .form-container-col {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: space-between;
    }

    /* Modal styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .buttonPrimary {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .buttonSecondary {
        background-color: #6c757d;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
</head>

<?php
// Include database connection
include("db_connection.php");
$event_id = '';
// Check if 'keyword' is set in the URL
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $query = "SELECT * FROM tickets WHERE event_id = '$event_id' AND is_deleted = false";
    $result = mysqli_query($conn, $query);

    $queryEvent = "SELECT * FROM event WHERE event_id  = '$event_id'";
    $resultEvent = mysqli_query($conn, $queryEvent);

    if (mysqli_num_rows($resultEvent) > 0) {

        $event = mysqli_fetch_assoc($resultEvent);

    } else {
        echo "Event not Found.";
    }
}
?>

<body class="app">
    <?php include('header.php'); ?>


    <div class="card" style="width:100%; margin-top: 20px">
        <div>
            <div class="cardTitleButton" style="padding-left: 6px; padding-bottom: 20px">
                <h2>Manage Ticket Category</h2>
                <div>
                    <button id="openModalBtn" class="buttonSecondary"><i style="color:white; padding-right:5px"
                            class="fa-solid fa-plus"></i> Add Category</button>
                </div>

            </div>
            <?php
            if (!$event['seatmapimage']) {
                ?>
            <form method="POST" action="uploadseatmap.php" enctype="multipart/form-data">
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <div class="form-group" style="width:50%; padding-bottom: 20px">
                    <div style="display: flex; align-items: end; ">
                        <div style="padding-right: 10px">
                            <label for="image">Upload Seatmap Image:</label>
                            <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.gif"
                                onchange="toggleButton()">
                        </div>

                        <button class="buttonSecondary" id="uploadButton" disabled>Upload Image</button>
                    </div>

                </div>

            </form>
            <?php
            } else {
                ?>
            <div style="width:50%; padding-bottom: 20px; ">
                <label>Uploaded Seatmap Image:</label>
                <img style="padding-top: 10px; " src="<?php echo $event['seatmapimage']; ?>" alt="seatmap" width="700"
                    height="400">
            </div>


            <?php
            }
            ?>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $index = 0;
                ?>
            <table>

                <thead>
                    <tr>
                        <th>Ticket Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Section</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                    <tr>
                        <td><?php echo $row['ticketname'] ?></td>
                        <td>RM <?php echo $row['ticketprice'] ?></td>
                        <td><?php echo $row['ticketquantity'] ?></td>
                        <td><?php echo $row['section'] ?></td>
                        <td>
                            <a onclick="confirmDelete('<?php echo $row['ticket_id']; ?>', '<?php echo $row['event_id']; ?>')"><i style="color: purple; cursor: pointer" class="fa-solid fa-trash"></i></a>
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



    <!-- Modal -->
    <div id="addTicketModal" class="modal">

        <div class="modal-content card">
            <div class="modal-header">
                <h2>Add Ticket</h2>
                <button class="close-btn" id="closeModalBtn">&times;</button>
            </div>
            <div class="card">
                <form method="POST" id="ticketForm" action="ticketadd.php">

                    <!-- Hidden field to pass event_id -->
                    <input type="hidden" name="event_id" value="<?php echo isset($event_id) ? $event_id : ''; ?>">
                    <input type="hidden" name="ticket_id" id="ticket_id">

                    <div class="form-group form-group-col">
                        <label for="ticketname">Ticket Name:</label>
                        <input type="text" id="ticketname" name="ticketname">
                    </div>

                    <div class="form-container  form-container-col">
                        <div class="form-group form-group-col">
                            <label for="ticketprice">Price:</label>
                            <input type="number" id="ticketprice" name="ticketprice">
                        </div>
                        <div class="form-group form-group-col">
                            <label for="ticketquantity">Quantity:</label>
                            <input type="number" id="ticketquantity" name="ticketquantity">
                        </div>
                        <div class="form-group form-group-col">
                            <label for="section">Section:</label>
                            <input type="text" id="section" name="section">
                        </div>
                    </div>
                    <button class="buttonSecondary">Submit</button>
                </form>
            </div>
        </div>

    </div>

    <script>
    const modal = document.getElementById('addTicketModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');

    const fileInput = document.getElementById('image');
    const uploadButton = document.getElementById('uploadButton');

    function toggleButton() {
        if (fileInput.files.length > 0) {
            uploadButton.disabled = false; // Enable button when a file is selected
        } else {
            uploadButton.disabled = true; // Disable button when no file is selected
        }
    }

    // Open modal
    openModalBtn.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    // Close modal
    closeModalBtn.addEventListener('click', () => {
        closeModal();
    });

    function editTicket(ticketname, ticketprice, ticketquantity, section, ticket_id, event_id) {
        document.getElementById('ticketname').value = ticketname;
        document.getElementById('ticketprice').value = ticketprice;
        document.getElementById('ticketquantity').value = ticketquantity;
        document.getElementById('section').value = section;
        document.getElementById('ticket_id').value = ticket_id;

        // Update the form action based on whether ticket_id is set
        const form = document.getElementById('ticketForm');
        if (ticket_id) {
            form.action = 'ticketedit.php'; // If editing, use ticketedit.php
        } else {
            form.action = 'ticketadd.php'; // If adding, use ticketadd.php
        }
        modal.style.display = 'flex';
    }

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    // Function to clear fields and close modal
    function closeModal() {
        modal.style.display = 'none';
        document.getElementById('ticketname').value = '';
        document.getElementById('ticketprice').value = '';
        document.getElementById('ticketquantity').value = '';
        document.getElementById('section').value = '';
        document.getElementById('ticket_id').value = '';
    }

    function confirmDelete(ticket_id, event_id) {
        console.log(ticket_id, event_id);
        // Show a confirmation dialog
        var confirmation = confirm("Are you sure you want to delete this ticket category?");
        if (confirmation) {
            window.location.href = "ticketdelete.php?ticket_id=" + ticket_id + "&event_id=" + event_id;
        }
    }

    // Close modal when clicking outside of it
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    </script>
</body>

</html>