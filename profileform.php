<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Profile - Carat Live</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<?php
// Include database connection
include("db_connection.php");

if (isset($_GET['user_id'])) {
	htmlspecialchars($_GET['user_id']);
    $user_id = $_GET['user_id'];
    
   
    $firstname= '';
    $lastname = '';
    $email = '';
    $password = '';
    $birthdate = '';
	$phonenumber = '';
	$address = '';


    // Prepare a parameterized query
    $query = "SELECT * FROM user WHERE id = $user_id";
    $result = mysqli_query($conn, $query);


	if(mysqli_num_rows($result) > 0){

		$user = mysqli_fetch_assoc($result);
        $firstname= $user['firstname'];
        $lastname = $user['lastname'];
        $email = $user['email'];
        $password = $user['password'];
        $birthdate = $user['birthdate'];
        $phonenumber = $user['phonenumber'];
        $address = $user['address'];

	} else{
		echo "User not Found.";
	}
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
    <!-- Main profile section with image on the left and form on the right -->
    <div style="display: flex; justify-content: center; height: 100vh; align-items: center;">
        <div class="profile-container" style="margin-top: 70px">
			<div class="profile-picture" id="profilePicContainer">
				<input type="file" id="profilePic" name="profilePic" accept="image/*">
				<i class="fas fa-user-circle" style="font-size: 200px; color: #ccc;"></i> <!-- Default User Icon -->
				<div class="icon-overlay">
					<i class="fas fa-camera" style="font-size: 30px; color: #007BFF;"></i> <!-- Camera icon on overlay -->
				</div>
			</div>
			<div class="profile-details">
				<h2>Your Profile</h2>
				<form action="profileedit.php" method="POST"> 
                <input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>"> 
					<div class="form-group">
						<label for="firstname">First Name:</label>
						<input type="text" id="firstname" name="firstname" <?php echo !empty($firstname) ? 'value="' . htmlspecialchars($firstname) . '"' : ''; ?>>
					</div>
					<div class="form-group">
						<label for="lastname">Last Name:</label>
						<input type="text" id="lastname" name="lastname" <?php echo !empty($lastname) ? 'value="' . htmlspecialchars($lastname) . '"' : ''; ?>>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" id="email" name="email" <?php echo !empty($email) ? 'value="' . htmlspecialchars($email) . '"' : ''; ?>>
					</div>
					<div class="form-group">
						<label for="birthdate">Birth Date:</label>
						<input type="date" id="birthdate" name="birthdate" <?php echo !empty($birthdate) ? 'value="' . htmlspecialchars($birthdate) . '"' : ''; ?>>
					</div>
					<div class="form-group">
						<label for="phonenumber">Phone Number:</label>
						<input type="phonenumber" id="phonenumber" name="phonenumber" <?php echo !empty($phonenumber) ? 'value="' . htmlspecialchars($phonenumber) . '"' : ''; ?>>
					</div>
					<div class="form-group">
						<label for="address">Address:</label>
						<input type="address" id="address" name="address" <?php echo !empty($address) ? 'value="' . htmlspecialchars($address) . '"' : ''; ?>>
					</div>
					<div style="text-align: center;">
                    <button class="buttonSecondary">
                    Update Profile
                    </button>
                </div>
				</form>
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

	// Function to validate the form (you can also add basic client-side validation here)
	function validateEventForm(user) {
          
		  var firstname = document.getElementById("firstname").value;
		  var lastname = document.getElementById("lastname").value;
		  var email = document.getElementById("email").value;
		  var birthdate = document.getElementById("birthdate").value;
		  var phonenumber = document.getElementById("phonenumber").value;
		  var address = document.getElementById("address").value;

		  // Make sure both fields are filled
		  if (!firstname || !lastname || !email|| !birthdate|| !phonenumber|| !address) {
			  alert("Please fill in all fields.");
			  return false; // Prevent form submission
		  }
		  return true; // Allow form submission
	  }
      function redirectToPage(page) {			
			page += `?user_id=${user.id}`;
            window.location.href = page;
        }

    </script>
<?php
// Start the session to check for error message
session_start();

// If there's an error message in session, show an alert
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Clear the error after displaying
}
?>
</body>
</html>
