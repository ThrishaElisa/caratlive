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

$user_email = '';
$role = '';

if (isset($_GET['role']) == 'user' && isset($_GET['user_email'])) {

    $user_email = $_GET['user_email'];
    $role = $_GET['role'];
    $query = "SELECT * FROM inquiry WHERE email = '$user_email' ORDER BY reply IS NOT NULL, reply ASC";
} else {
    //PENDING answer will be on top of the list
    $query = "SELECT * FROM inquiry ORDER BY reply IS NOT NULL, reply ASC";
}

$result = mysqli_query($conn, $query);

?>

<body class="app">
    <div style="display: flex; justify-content: center;">
        <div class="event-container" style="margin-top:50px; width:100%">
            <h2>Inquiries List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <?php if (!$user_email) { ?>
                            <th>Internal User</th>
                        <?php } ?>
                        <th>Message</th>
                        <th>Reply Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $index = 0;

                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <?php if (!$user_email) { ?>
                                    <?php if ($row['internaluser'] == 1) { ?>
                                        <td style="color:purple">Yes</td>
                                    <?php } else { ?>
                                        <td style="color:red">No</td>
                                    <?php } ?>
                                <?php } ?>
                                <td><?php echo $row['message'] ?></td>
                                <?php if ($row['reply']) { ?>
                                    <td style="color:green">Replied</td>
                                <?php } else { ?>
                                    <td style="color:orange">Pending</td>
                                <?php } ?>
                                <?php
                                if (!$row['reply'] && $role !== 'user') {
                                    ?>
                                    <td><a onclick="redirectToPage('contactus.php?inquiry_id=<?php echo $row['id']; ?>&mode=edit')"><i
                                                style="color: purple" class="fa-solid fa-reply"></i></a></td>
                                <?php } else { ?>
                                    <td><a onclick="redirectToPage('contactus.php?inquiry_id=<?php echo $row['id']; ?>&mode=view')"><i
                                                style="color: purple" class="fa-solid fa-eye"></i></a></td>
                                <?php } ?>
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

    <script>
        let path = window.location.pathname;
        // Get the query string from the current URL
        let params = new URLSearchParams(window.location.search);

        let userEmail = params.get('user_email'); // 'example@example.com
        let role = localStorage.getItem('role');

        if (role == "user" && !userEmail) {
            window.location.href = `${window.location.pathname}?role=user&user_email=${user.email}`;
        }
    </script>
</body>

</html>