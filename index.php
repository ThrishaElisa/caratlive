<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home - Carat Live </title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

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
<?php
    // Include the database connection
    include 'db_connection.php';

    // Check the connection and output a JavaScript alert
    if ($conn->connect_error) {
        echo "<script>alert('Connection failed: " . $conn->connect_error . "');</script>";
    }

    // Close the connection
    $conn->close();
    ?>

    <!-- Main content -->
	<div class="slideshow-container">
		<div class="mySlides fade">
			<img src="assets/lany.png" alt="poster" style="width:100%">
		</div>
		<div class="mySlides fade">
			<img src="assets/greenday.png" alt="poster" style="width:100%">
		</div>
		<div class="mySlides fade">
			<img src="assets/marron5.png" alt="poster" style="width:100%">
		</div>	
	</div>
	<!-- Dots at the bottom for manual slide navigation -->
	<div class="dot-container" style="text-align:center">
		<span class="dot" onclick="currentSlide(1)"></span> 
		<span class="dot" onclick="currentSlide(2)"></span> 
		<span class="dot" onclick="currentSlide(3)"></span> 
	</div>
	<div class= "cardSearch">
		<div class="input-search">
			<input   onkeydown="if (event.key === 'Enter') searchEvents()" type="text" class="input-field" name="keyword" id="keyword" placeholder="Search Events by Artist Name or Event Name...">
		</div>
		<button class="buttonSecondary">Find Events</button>
	</div>
	<div class="card">	
		<div class="cardTitleButton" style="margin-bottom:20px;padding-left: 6px">
			<h2 >Upcoming Events</h2>
			<a href="event.php">View More..</a>
		</div>	
		<div class="responsive">
		  <div class="gallery">
			<a target="_blank">
			  <img src="assets/greenday.png" alt="events" width="400" height="300">
			</a>
		  </div>
		</div>
		
		<div class="responsive">
		  <div class="gallery">
			<a target="_blank">
			  <img src="assets/marron5.png" alt="events" width="400" height="300">
			</a>
		  </div>
		</div>					 

		<div class="responsive">
		  <div class="gallery">
			<a target="_blank">
			  <img src="assets/bruno.png" alt="events" width="400" height="300">
			</a>
		  </div>
		</div>

		<div class="responsive">
		  <div class="gallery">
			<a target="_blank">
			  <img src="assets/keshi.png" alt="events" width="400" height="300">
			</a>
		  </div>
		</div>	
	</div>
	
	<div class="card" style="margin-top:20px">
		
		<div class="cardTitleButton" style="padding-left: 6px">
			<h2>Previous Events</h2>
		</div>	
		<div class="listPreviousEvent" >		  
			<video width="420" height="240" controls>
			  <source src="assets/seventeenTrailer.mp4" type="video/mp4" >
			  Your browser does not support the video tag.
			</video>
			<div class="listPreviousEventDesc">
				<h2>SEVENTEEN WORLD TOUR [FOLLOW]</h2>
				<div>SEVENTEEN Follow Tour in Malaysia, held in Bukit Jalil National Stadium, was an electrifying event. The venue is transformed into a dazzling showcase of SEVENTEEN’s signature colors and cutting-edge stage design. The concert kicks off with an explosive opening sequence, featuring a high-energy medley of their biggest hits. The group delivers a dynamic setlist "CLAP", "VERY NICE" and newer track that includes everything from upbeat dance tracks to emotional ballads, with each member getting their moment to shine. The production value is top-notch, with stunning visual effects and elaborate costume changes enhancing the performance. As the show winds down, the group returns for an encore that includes unexpected surprises, leaving Carats buzzing with excitement.
				</div>
			</div>
		</div>
		<div class="listPreviousEvent">		  
			<video width="420" height="240" controls>
			  <source src="assets/blackpinktrailer.mp4" type="video/mp4" >
			  Your browser does not support the video tag.
			</video>
			
			<div class="listPreviousEventDesc">
				<h2>BLACKPINK WORLD TOUR [BORN PINK]</h2>
				<div>BLACKPINK's Born Pink concert in Malaysia, held at Bukit Jalil National Stadium, was an electrifying event that thrilled fans with high-energy performances of hits like "How You Like That," "Kill This Love," and newer tracks from their *Born Pink* album. The concert featured stunning visuals, intricate choreography, and bold costume changes that added to the spectacle. Each member had solo stages, showcasing their individual talents, with Jennie, Rosé, Lisa, and Jisoo delivering captivating performances. Throughout the night, BLACKPINK interacted with their Malaysian fans, speaking in English and Malay, and encouraging everyone to sing and dance along. The stadium was filled with pink lights from fans' lightsticks, creating an unforgettable atmosphere of excitement and unity.
				</div>
			</div>
		</div>
		<div class="listPreviousEvent">		  
			<video width="420" height="240" controls>
			  <source src="assets/coldplayTrailer.mp4" type="video/mp4" >
			  Your browser does not support the video tag.
			</video>			 
			<div class="listPreviousEventDesc">
				<h2>COLDPLAY WORLD TOUR: MUSIC OF THE SPHERES</h2>
				<div>Coldplay’s Music of the Spheres concert in Malaysia was a spectacular and immersive experience, held at the Bukit Jalil National Stadium in Kuala Lumpur. The show featured stunning visuals, including cosmic-themed projections and the iconic LED wristbands that lit up the stadium in sync with the music. The band performed a mix of classic hits like "Yellow" and "Fix You," along with new tracks like "My Universe," delivering a dynamic blend of energy and emotion. Chris Martin engaged warmly with the crowd, even speaking a few words in Bahasa Malaysia, which thrilled the audience. In line with their sustainability efforts, the concert incorporated eco-friendly initiatives, using renewable energy and encouraging recycling. The night ended with confetti showers and fireworks, leaving fans euphoric and making the concert a standout event in Malaysia.
				</div>
			</div>
	    </div>

    <!-- Embedding the footer -->
    <div id="footer">
        <iframe src="footer.html" style="border: none; width: 100%;"></iframe>
    </div>
	</div>
	
	<!-- JavaScript code for the nav bar & slideshow -->
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
		document.getElementById('logout-button').style.display = 'none';//make it disappear
		console.log('No user is logged in.');
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

	 let slideIndex = 0;
        showSlides();

        // Function to show the slides
        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";  
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }

		function searchEvents() {
        // Get the value from the input field
        const keyword = document.getElementById("keyword").value;
        
        // Redirect to the current URL with the keyword parameter
        window.location.href = `event.php?keyword=${encodeURIComponent(keyword)}`;
    	}

		function redirectToPage(page) {			
			page += `?user_id=${user.id}&mode=edit`;
            window.location.href = page;
        }
	</script>
</body>
</html>
