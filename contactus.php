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


$name = '';
$email ='';
$message='';
$reply='';
$inquiry_id = '';
$mode='';

// Query to fetch info
if(isset($_GET['inquiry_id'])){

	$inquiry_id = $_GET['inquiry_id'];
    $mode = $_GET['mode'];

	$query = "SELECT * FROM inquiry WHERE id = $inquiry_id";
	$result = mysqli_query($conn, $query); //run query

	if(mysqli_num_rows($result) > 0){

		$event = mysqli_fetch_assoc($result);
        $name = $event['name'];
        $email = $event['email'];
        $message= $event['message'];
        $reply= $event['reply'];

	} else{
		echo "Event not Found.";
	}
} else {
	echo "No Inquiry ID provided.";
}
?>
	
<!-- Header - navigation bar to other page  -->
<header class="header">
	<nav  class="navbar">
		<div class="logo">
			<span class="logoCarat">CARAT</span><span class="logoLive">Live</span>
        </div>
        <div id="user-navbar">
             <a href="index.php">HOME</a>
             <a href="event.php">EVENTS</a>
             <a href="contactus.php">CONTACT US</a>
             <a href="about%20us.html">ABOUT US</a>
        </div>
		<div id="admin-navbar">
			<a href="index.php">HOME</a>
            <a href="event.php">MANAGE EVENTS</a>
			<a href="inquiries.php">MANAGE Q&A</a>
        </div>
       <a href="loginform.php"><button id="login-button" class="buttonSecondary">LOG IN</button></a>  
		<div id="loggedin-nav">
			<a id="welcome-message"></a>
			<a onclick="logout()" id="logout-button"><i style="color: white" class="fa-solid fa-right-from-bracket"></i></a>
		</div>
   </nav>
</header>
	
<body class="app">
    <!-- Contact Us Section -->
    <div style="display: flex; justify-content: center; height: 70vh; align-items: center;">
        <div class="contact-container">
            <h2 id="title-contact-us"></h2>
            <p id="desc-contact-us"></p>
            <form action="<?php echo ($mode == 'edit') ? 'contactusedit.php' : 'contactusadd.php'; ?>" method="POST"> <!-- Replace with your form handling script -->
                <div class="form-group">
                    <label for="name" id="name-label"></label>
                    <input type="text" id="name" name="name" required <?php echo !empty($name) ? 'value="' . htmlspecialchars($name) . '"' : ''; ?>>
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
                    <label for="email"  id="email-label"></label>
                    <input type="email" id="email" name="email" required <?php echo !empty($email) ? 'value="' . htmlspecialchars($email) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="message"  id="message-label"></label>
                    <textarea id="message" name="message" rows="4" required> <?php echo !empty($message) ? htmlspecialchars($message) : ''; ?> </textarea>
                </div>

                <div class="form-group" id="reply-area">
                    <label for="reply" >Your Reply</label>
                    <textarea id="reply" name="reply" rows="4" <?php echo ($mode == 'edit') ? 'required="true"' : ''; ?> > <?php echo !empty($reply) ? htmlspecialchars($reply) : ''; ?> </textarea>
                </div>
                <?php                 
                if ($mode !== 'view'){
                ?>
                <button class="buttonSecondary" id="button-contact-us" ></button>
                <?php 
                }
                ?>
            </form>
            <?php  
            if ($mode == 'view'){
                ?>
                <button class="buttonSecondary" onclick="redirectToPage('inquiries.php')" > Back</button>
                <?php 
                }
            ?>
        </div>
    </div>

    <script>
        // Retrieve the user data from localStorage
        const user = JSON.parse(localStorage.getItem('user'));
      
        // Check if user data exists in localStorage
        if (user) {
            // Example: Show user info on the page
            document.getElementById('welcome-message').innerHTML = 'Welcome, ' + user.firstname;
            document.getElementById('loggedin-nav').style.display = 'block';//make it appear
            document.getElementById('login-button').style.display = 'none';//make it disappear
        } 
        else {
            console.log('No user is logged in.');
            document.getElementById('logout-button').style.display = 'none';//make it disappear
        }
    
        if(localStorage.getItem('role')== 'admin'){
            document.getElementById('admin-navbar').style.display = 'block';//make it appear
            document.getElementById('user-navbar').style.display = 'none';//make it disappear
            // Get the query string from the URL
            let urlParams = new URLSearchParams(window.location.search);

            // Access the 'mode' parameter
            let mode = urlParams.get('mode');

            if(mode ==='edit'){
                document.getElementById("button-contact-us").textContent = "Send Reply";
            }else{
                document.getElementById("reply").readOnly = true;
            }           
            document.getElementById("title-contact-us").textContent  = 'Reply to a customer\'s inquiry';
            document.getElementById("name-label").textContent  = 'Customer\'s Name';
            document.getElementById("email-label").textContent  = 'Customer\'s Email';
            document.getElementById("message-label").textContent  = 'Customer\'s Message';
            document.getElementById('desc-contact-us').style.display = 'none';//make it disappear
            document.getElementById("name").readOnly = true;
            document.getElementById("email").readOnly = true;
            document.getElementById("message").readOnly = true;
        } 
        else{
            if (user) {
                document.getElementById("name").value = user['firstname'] + " " + user['lastname'];
                document.getElementById("email").value = user['email'];
            }
            document.getElementById('user-navbar').style.display = 'block';//make it disappear
            document.getElementById('admin-navbar').style.display = 'none';//make it disappear
            document.getElementById('reply-area').style.display = 'none';//make it disappear


            document.getElementById("button-contact-us").textContent = "Send Message";
            document.getElementById("title-contact-us").textContent  = 'Contact Us'
            document.getElementById("name-label").textContent  = 'Name';
            document.getElementById("email-label").textContent  = 'Email';
            document.getElementById("message-label").textContent  = 'Message';
            document.getElementById("desc-contact-us").textContent = "If you have any questions, feedback, or just want to say hi, feel free to get in touch with us. We'd love to hear from you!"
        }
        function logout() {
            localStorage.clear();  // Clear all localStorage items
            window.location.href = 'loginform.php'; // Redirect to login.php
        }
        function redirectToPage(page) {
            window.location.href = page;
        }
    
    </script>
   
</body>
</html>

