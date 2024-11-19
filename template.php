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

$title = '';
$description = '';
$link = '#';
$linkdesc = '';

if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $description = $_GET['description'];
    $link = $_GET['link'];
    $linkdesc = $_GET['linkdesc'];
}
?>

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
        <div id="admin-navbar">
            <a href="index.php">HOME</a>
            <a href="event.php">MANAGE EVENTS</a>
            <a href="inquiries.php">MANAGE Q&A</a>
        </div>
        <a href="loginform.php"><button id="login-button" class="buttonSecondary">LOG IN</button></a>
        <div id="loggedin-nav">
            <a href="profileform.php" id="welcome-message"></a>
            <a onclick="logout()" id="logout-button"><i style="color: white"
                    class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </nav>
</header>

<body class="app">
    <!-- Contact Us Section -->
    <div style="display: flex; justify-content: center; height: 70vh; align-items: center;">
        <div class="contact-container">
            <h2><?php echo $title ?></h2>
            <p><?php echo $description ?></p>
            <div style="padding-top:10px">
                <button class="buttonSecondary"
                    onclick="redirectToPage('<?php echo $link ?>')"><?php echo $linkdesc ?></button>
            </div>


        </div>
    </div>

    <script>

        localStorage.setItem('purchase', null);
        // Retrieve the user data from localStorage
        const user = JSON.parse(localStorage.getItem('user'));

        // Check if user data exists in localStorage
        if (user) {
            // Example: Show user info on the page
            document.getElementById('welcome-message').innerHTML = ('WELCOME, ' + user.firstname).toUpperCase();
            document.getElementById('loggedin-nav').style.display = 'block';//make it appear
            document.getElementById('login-button').style.display = 'none';//make it disappear
        }
        else {
            console.log('No user is logged in.');
            document.getElementById('logout-button').style.display = 'none';//make it disappear
        }

        if (localStorage.getItem('role') == 'admin') {
            document.getElementById('admin-navbar').style.display = 'block';//make it appear
            document.getElementById('user-navbar').style.display = 'none';//make it disappear
        }
        else {
            document.getElementById('user-navbar').style.display = 'block';//make it disappear
            document.getElementById('admin-navbar').style.display = 'none';//make it disappear
        }
        function logout() {
            localStorage.clear();  // Clear all localStorage items
            window.location.href = 'loginform.php'; // Redirect to login.php
        }

        function redirectToPage(page) {
            if(page =='receipt.php'){
                let params = new URLSearchParams(window.location.search);
                let purchase_id = params.get('purchase_id');
                page+= "?purchase_id="+purchase_id;
            }
        
            window.location.href = page;
        }

    </script>

</body>

</html>