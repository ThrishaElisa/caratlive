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
	<!-- <div class="moreinfo-card" style="margin-top: 30px">
		<div>
           <p><strong>RM1450.00, RM950.00, RM698.00, RM598.00, RM498.00, RM398.00, RM298.00</strong></p>
			<p> <strong>*Ticket price excludes ticket fee and booking charges</strong></p><br>
			<p>Enjoy special access to the for <strong>MASTERCARD</strong> PREFFERED* cardholders globally! </p><br><br>
			<h2>ONSALE DETAILS</h2><br><br>

			<p><strong>Artist Presale</strong></p>
			<p>📆 29 July 2024, Monday</p>
			<p>⏰10 AM - 11:59 PM - The waiting room starts at 9 AM</p><br><br>

			<p><strong>MasterCard Presale</strong></p>
			<p>📆 30 July 2024, Tuesday till 1 Aug 2024, Thursday</p>
			<p>⏰10 AM - 10 AM - The waiting room starts at 9 AM</p><br><br>

			<p><strong>Live Nation Presale</strong></p>
			<p>📆 1 Aug 2024, Thursday</p>
			<p>⏰ 12 PM - 11:59 PM - The waiting room starts at 11 AM</p><br><br>

			<p><strong>General Onsale</strong></p>
			<p>📆 2 Aug 2024, Friday</p>
			<p>⏰ 11 AM onwards - The waiting room starts at 10 AM</p><br>
			
			<hr style="border: 1px solid #9A9A9A; width: 100%;"><br>
			
			<h2>TICKET PRICES</h2>
			<p><strong>RM 1,450 - "UNDERSTAND" SOUNDCHECK PACKAGE</strong></p>
			<p><strong>	RM 950 - "LIMBO" VIP MERCH PACKAGE</strong></p>
			<p><strong>	RM 698 - CAT 1</strong></p>
			<p><strong>	RM 598 - CAT 2</strong></p>
			<p>	<strong>RM 498 - CAT 3</strong></p>
			<p><strong>	RM 398 - CAT 4 (STANDING ZONE)</strong></p>
			<p><strong>	RM 398 - CAT 5</strong></p>
			<p><strong>	RM 298 - CAT 6</strong></p><br>
			<p><em>*Ticket prices shown exclude Booking Fees, and Transaction charges</em></p><br>
			
			<hr style="border: 1px solid #9A9A9A; width: 100%;"><br>
			<h2>VIP INFORMATION</h2><br>
			<p><strong>UNDERSTAND SOUNDCHECK PACKAGE</strong></p>
			<p>Package Price : RM1,450</p>
			<p>Inclusions:</p>
			<p>- Inclusive of one RM 398 standing ticket</p>
			<p>- Meet & Greet and Photo Opportunity with Keshi (NEW)</p>
			<p>- Access to pre-show Keshi soundcheck party</p>
			<p>- One VIP Exclusive Tour Print, Signed by Keshi</p>
			<p>- One Premium Merch Package</p>
			<p>- Early entry into performance hall (1st Tier)</p>
			<p>- Early access to merch stand (if applicable)</p>
			<p>- On site VIP host (NEW)</p><br>
			
			<p><strong>LIMBO VIP MERCH PACKAGE</strong></p>
			<p>Package Price : RM950</p>
			<p>Inclusions:</p>
			<p>- Inclusive of one RM 398 standing ticket</p>
			<p>- One Premium Merch Package </p>
			<p>- Early entry into performance hall (2nd Tier)</p>
			<p>- Early access to merch stand (if applicable)</p><br>
			
			<hr style="border: 1px solid #9A9A9A; width: 100%;"><br>
			
			<h2>ABOUT</h2>
			<p>Born Casey Luong, keshi has emerged as a creative alchemist of the highest order, layering universally resonant hooks atop inventive and immersive soundscapes. He materialized out of Houston, TX with the EP trilogy—skeletons (2019), bandaids (2020), and always (2020). Plus, he notably contributed “War With Heaven” to Marvel’s Shang-Chi and the Legend of the Ten Rings: The Album. Brands such as YSL, Fender, Microsoft and Fendi have sought him out for collaborations. During 2022, keshi reached critical mass with his debut LP, GABRIEL. It tallied billions of streams fueled by “LIMBO,” “UNDERSTAND,” “GET IT,” and more. keshi notably achieved the “Top New Artist Debut of 2022,” scoring “the highest first-week sales of the year for a debut album” landing him on the Top 20 of the Billboard 200 and Top 5 of the Top Album Sales Chart. GABRIEL also affirmed him as a headlining force of nature. He concluded the LP’s sold out tour cycle with two sold-out nights at Radio City Music Hall in New York, NY and a pair of sold-out dates at The Greek Theatre in Los Angeles, CA. Now, he draws everyone into his world with a worldwide arena tour ahead of 2024’s Requiem.</p><br>
			
			<hr style="border: 1px solid #9A9A9A; width: 100%;"><br>
			
        </div>
     
	</div> -->
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

</script>
</body>
</html>
