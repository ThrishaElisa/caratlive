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
    <nav class="navbar">
        <!-- logo -->
        <div class="logo">
            <span class="logoCarat">CARAT</span><span class="logoLive">Live</span>
        </div>

        <!-- navigation -->
        <div>
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
        </div>
        <!-- action button -->
        <div style="display:flex; align-items: center">
            <a href="loginform.php"><button id="login-button" class="buttonSecondary">LOG IN</button></a>
            <div id="loggedin-nav">
                <div class="dropdown" style="width: 250px;">
                    <span class="welcome-label"
                        id="welcome-message"></span><i class="fa-solid fa-ellipsis-vertical dropbtn"></i>
                    <ul class="dropdown-content" style="list-style-type: none">
                        <li id="user-profile" onclick="redirectToPage('profileform.php')" class="dropdown-item">
                            <i class="fa-solid fa-user"></i> My Profile
                        </li>
                        <li id="user-purchase" onclick="redirectToPage('historypurchased.php')" class="dropdown-item">
                            <i class="fa-solid fa-receipt"></i>Purchase History
                        </li>
                        <li id="user-inquiry" onclick="redirectToPage('inquiries.php')" class="dropdown-item">
                            <i class="fa-regular fa-comment"></i>Inquiry
                        </li>
                        <li onclick="logout()" class="dropdown-item" id="logout-button"><i
                                class="fa-solid fa-right-from-bracket"></i> Logout</li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- JavaScript code for the nav bar & slideshow -->
<script>
// Retrieve the user data from localStorage
const user = JSON.parse(localStorage.getItem('user'));

// Check if user data exists in localStorage
if (user) {
    // Example: Show user info on the page

    document.getElementById('welcome-message').innerHTML = ('Welcome, ' + user.firstname).toUpperCase();
    document.getElementById('loggedin-nav').style.display = 'block'; //make it appear
    document.getElementById('login-button').style.display = 'none'; //make it disappear
} else {
    document.getElementById('logout-button').style.display = 'none'; //make it disappear
    document.getElementById('loggedin-nav').style.display = 'none'; //make it disappear
    console.log('No user is logged in.');
}

if (localStorage.getItem('role') == 'admin') {
    document.getElementById('admin-navbar').style.display = 'block'; //make it appear
    document.getElementById('user-navbar').style.display = 'none'; //make it disappear
    document.getElementById('user-profile').style.display = 'none'; //make it disappear
    document.getElementById('user-purchase').style.display = 'none'; //make it disappear
    document.getElementById('user-inquiry').style.display = 'none'; //make it disappear
} else {
    document.getElementById('user-navbar').style.display = 'block'; //make it appear
    document.getElementById('admin-navbar').style.display = 'none'; //make it disappear
    document.getElementById('user-profile').style.display = 'block'; //make it appear
}

function logout() {
    localStorage.clear(); // Clear all localStorage items
    window.location.href = 'loginform.php'; // Redirect to login.php
}

function redirectToPage(page) {
    if (page == 'profileform.php' || page == 'historypurchased.php')
        page += `?user_id=${user.id}&mode=edit`;

    window.location.href = page;
}
</script>

</html>