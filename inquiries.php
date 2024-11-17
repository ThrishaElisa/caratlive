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

//PENDING answer will be on top of the list
$query = "SELECT * FROM inquiry ORDER BY reply IS NOT NULL, reply ASC";
$result = mysqli_query($conn, $query);

?>
	
<body class="app">
    <div style="display: flex; justify-content: center; height: 70vh; ">
     <div class="event-container" style="margin-top:50px; width:100%">
        <h2>Inquiries List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Internal User</th>
                    <th>Message</th>                     
                    <th>Reply Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    $index=0;

                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['email']?></td>
                    <?php if ($row['internaluser']== 1) { ?><td style="color:purple">Yes</td>
                    <?php } else { ?><td style="color:red">No</td>
                    <?php } ?>
                    <td><?php echo $row['message']?></td>
                    <?php if ($row['reply']) { ?><td style="color:green">Replied</td>
                    <?php } else { ?><td style="color:orange">Pending</td>
                    <?php } ?>
                <?php 
                    if(!$row['reply']){
                ?>
                    <td><a onclick="redirectToPage('contactus.php?inquiry_id=<?php echo $row['id'];?>&mode=edit')"><i style="color: purple" class="fa-solid fa-reply"></i></a></td>
                    <?php }
                
                else { ?>
                    <td><a onclick="redirectToPage('contactus.php?inquiry_id=<?php echo $row['id'];?>&mode=view')"><i style="color: purple" class="fa-solid fa-eye"></i></a></td>
                <?php } ?>
                    </tr>
                <?php }
                }
                else { ?>
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

<style>
    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        
    }

    /* Header Styling */
    th {
        background-color: purple;
        color: white;
        padding: 12px;
        text-align: left;
    }

    /* Row Styling */
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    /* Hover Effect */
    tr:hover {
        background-color: #f1f1f1;
    }

    /* Alternating Row Colors */
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>