<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Carat Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
    // Function to validate the form (you can also add basic client-side validation here)
    function validateLoginForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        // Make sure both fields are filled
        if (!email || !password) {
            alert("Please fill in both fields.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
    </script>

</head>

<!-- Header - navigation bar to other page  -->
<header class="header">
    <nav class="navbar">
        <div class="logo">
            <span class="logoCarat">CARAT</span><span class="logoLive">Live</span>
        </div>
        <div id="user-navbar">
            <a href="index.php">HOME</a>
            <a href="event.php">EVENTS</a>
            <a href="contactus.php">CONTACT US</a>
            <a href="aboutus.php">ABOUT US</a>
        </div>
        <div></div>
        <div></div>
    </nav>
</header>

<body class="app">
    <div style="display: flex; justify-content: center; margin-top: 50px;">
        <div class="sign-container">
            <h2>Log In</h2>
            <form action="login.php" method="POST" onsubmit="return validateLoginForm()">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>
                <div style="text-align: center;">
                    <button class="buttonSecondary">Log In</button>
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    <a href="signup.html">Don't have an account? Sign Up</a>
                </div>
            </form>
        </div>
    </div>

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
<script>
localStorage.clear();
</script>