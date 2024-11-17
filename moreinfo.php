<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>More Info - Carat Live</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php
// Include database connection
include("db_connection.php");

// Query to fetch all event
if(isset($_GET['event_id'])){

	$event_id = $_GET['event_id'];

	$query = "SELECT * FROM event WHERE event_id = $event_id";
	$result = mysqli_query($conn, $query); //run query

	if(mysqli_num_rows($result) > 0){

		$event = mysqli_fetch_assoc($result);

	} else{
		echo "Event not Found.";
	}
} else {
	echo "No event ID provided.";
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
             <a href="aboutus.html">ABOUT US</a>
        </div>
		<div id="admin-navbar">
			<a href="index.php">HOME</a>
            <a href="event.php">MANAGE EVENTS</a>
			<a href="inquiries.php">MANAGE Q&A</a>
        </div>
       <a href="loginform.php"><button id="login-button" class="buttonSecondary">LOG IN</button></a>  
		<div id="loggedin-nav">
			<a  onclick="redirectToPage('profileform.php')" id="welcome-message"></a>
			<a onclick="logout()" id="logout-button"><i style="color: white" class="fa-solid fa-right-from-bracket"></i></a>
		</div>
   </nav>
</header>
	
<body class="app">
<div class="card" style="margin-top:70px">
	<h1 ><?php echo $event['artistname']; ?>: <?php echo $event['eventname']; ?></h1><br>
	<div class="moreinfo-card">
		<img src="<?php echo $event['image']; ?>" alt="poster" width="700" height="400">
		<div style="padding-left: 50px">
			<p><i class="fa-solid fa-location-dot"></i><?php echo $event['location']; ?></p><br>
			<p><i class="fa-solid fa-calendar-days"></i><?php echo $event['date']; ?></p></p><br>
			<p><i class="fa-solid fa-clock"></i><?php echo $event['time']; ?></p><br>
			<p><?php echo $event['description']; ?></p>
			<div style= "padding-top: 40px" >
			<button class="buttonSecondary">Buy Tickets Now</button>
			</div>
		</div>
	</div>
	<div class="moreinfo-card" style="margin-top: 30px; padding: 40px"> 
		<div class="ck-content">
			<?php echo $event['content']; ?>
		</div>
		
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
	} 
	else{
		document.getElementById('user-navbar').style.display = 'block';//make it disappear
		document.getElementById('admin-navbar').style.display = 'none';//make it disappear
	}
	function logout() {
    	localStorage.clear();  // Clear all localStorage items
        window.location.href = 'loginform.php'; // Redirect to login.php
    }
	function redirectToPage(page) {			
			page += `?user_id=${user.id}&mode=edit`;
            window.location.href = page;
        }

</script>
</body>
</html>
