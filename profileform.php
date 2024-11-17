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
include('header.php');

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

<body class="app">
    <!-- Main profile section with image on the left and form on the right -->
    <div style="display: flex; justify-content: center;">
        <div class="profile-container" style="margin-top: 70px">
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
</div>		

<script>
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
    </script>
</body>
</html>
