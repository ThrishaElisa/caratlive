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

$name = '';
$email ='';
$message='';
$reply='';
$inquiry_id = '';
$mode='';
$internaluser = '';

// Query to fetch info
if(isset($_GET['inquiry_id'])){

	$inquiry_id = $_GET['inquiry_id'];
    $mode = $_GET['mode'];


	$query = "SELECT * FROM inquiry WHERE id = $inquiry_id";
	$result = mysqli_query($conn, $query); //run query

	if(mysqli_num_rows($result) > 0){

		$inquiry = mysqli_fetch_assoc($result);
        $name = $inquiry['name'];
        $email = $inquiry['email'];
        $message= $inquiry['message'];
        $reply= $inquiry['reply'];
        $internaluser= $inquiry['internaluser'];

	} else{
		echo "Inquiry not Found.";
	}
} else {
	echo "No Inquiry ID provided.";
}
?>

<body class="app">
    <!-- Contact Us Section -->
    <div style="display: flex; justify-content: center; height: 70vh; align-items: center;">
        <div class="contact-container">
            <h2 id="title-contact-us"></h2>
            <p id="desc-contact-us"></p>
            <form action="<?php echo ($mode == 'edit') ? 'contactusedit.php' : 'contactusadd.php'; ?>" method="POST">
                <!-- Replace with your form handling script -->
                <div class="form-group">
                    <label for="name" id="name-label"></label>
                    <input type="text" id="name" name="name" required
                        <?php echo !empty($name) ? 'value="' . htmlspecialchars($name) . '"' : ''; ?>>
                </div>
                <?php                 
                if ($mode == 'edit'){
                ?>
                <!-- Hidden field to pass event_id -->
                <input type="hidden" name="inquiry_id" value="<?php echo isset($inquiry_id) ? $inquiry_id : ''; ?>">

                <?php 
                }

                ?>
                <div class="form-group">
                    <label for="email" id="email-label"></label>
                    <input type="email" id="email" name="email" required
                        <?php echo !empty($email) ? 'value="' . htmlspecialchars($email) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="message" id="message-label"></label>
                    <textarea id="message" name="message" rows="4"
                        required> <?php echo !empty($message) ? htmlspecialchars($message) : ''; ?> </textarea>
                </div>

                <div style="<?php echo $internaluser == '0' && $mode != 'view' ? 'display:none' : '' ?> "
                    class="form-group" id="reply-area">
                    <label for="reply">Admin's Reply</label>
                    <textarea id="reply" name="reply" rows="4"
                        <?php echo ($mode == 'edit') ? 'required="true"' : ''; ?>> <?php echo !empty($reply) ? htmlspecialchars($reply) : ''; ?> </textarea>
                </div>
                <?php  
                if ($internaluser == '0' && $mode != 'view'){
                ?>
                <div style="padding-top: 10px; padding-bottom: 10px; color: gray">Note: This is an external user. Please
                    reply this through an email. Please click the button below if you already answer this message
                    through an email</div>
                <?php 
                }
                ?>

                <?php                 
                if ($mode !== 'view'){
                ?>
                <button class="buttonSecondary" id="button-contact-us"></button>
                <?php 
                }
                ?>
            </form>
            <?php  
            if ($mode == 'view'){
                ?>
            <button class="buttonSecondary" onclick="redirectToPage('inquiries.php')"> Back</button>
            <?php 
                }
            ?>
        </div>
    </div>

    <script>
    if (localStorage.getItem('role') == 'admin') {
        // Get the query string from the URL
        let urlParams = new URLSearchParams(window.location.search);

        // Access the 'mode' parameter
        let mode = urlParams.get('mode');

        if (mode === 'edit') {
            if ("<?php echo $internaluser; ?>" == '0') {
                document.getElementById("reply").value = "Replied through Email";
            }
            document.getElementById("button-contact-us").textContent = "<?php echo $internaluser; ?>" == '1' ?
                "Send Reply" : "Mark as Replied";
        } else {
            document.getElementById("reply").readOnly = true;
        }
        document.getElementById("title-contact-us").textContent = 'Reply to a customer\'s inquiry';
        document.getElementById("name-label").textContent = 'Customer\'s Name';
        document.getElementById("email-label").textContent = 'Customer\'s Email';
        document.getElementById("message-label").textContent = 'Customer\'s Message';
        document.getElementById('desc-contact-us').style.display = 'none'; //make it disappear
        document.getElementById("name").readOnly = true;
        document.getElementById("email").readOnly = true;
        document.getElementById("message").readOnly = true;
    } else {
        let params = new URLSearchParams(window.location.search);

        let mode = params.get('mode');
        if (user) {
            document.getElementById("name").value = user['firstname'] + " " + user['lastname'];
            document.getElementById("email").value = user['email'];
        }
        if (mode !== 'view') {
            document.getElementById('reply-area').style.display = 'none'; //make it disappear
            document.getElementById("button-contact-us").textContent = "Send Message";
        } else {
            document.getElementById("reply").readOnly = true;
            document.getElementById("name").readOnly = true;
            document.getElementById("email").readOnly = true;
            document.getElementById("message").readOnly = true;
        }
        document.getElementById("title-contact-us").textContent = 'Contact Us'
        document.getElementById("name-label").textContent = 'Name';
        document.getElementById("email-label").textContent = 'Email';
        document.getElementById("message-label").textContent = 'Message';
        document.getElementById("desc-contact-us").textContent =
            "If you have any questions, feedback, or just want to say hi, feel free to get in touch with us. We'd love to hear from you!"
    }
    </script>
</body>

</html>