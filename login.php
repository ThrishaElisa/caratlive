<?php
// Start the session
session_start();

// Include the database connection file
include("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strpos($email, '@caratlive.com') !== false) {
        $query = "SELECT * FROM admin WHERE email = '$email'";
    } else {
        // Check if the user exists in the database
        $query = "SELECT * FROM user WHERE email = '$email'";
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Email doesn't exist, set session error message
        $_SESSION['error'] = "Email not found.";
        header("Location: loginform.php");

    } else {
        // Email exists, now check if the password is correct
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            // Password matches, login successful
            if (strpos($email, '@caratlive.com') !== false) {
                $_SESSION['user'] = [
                    'id' => $row['id'],
                    'email' => $row['email'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                ];
            } else {
                $_SESSION['user'] = [
                    'id' => $row['id'],
                    'email' => $row['email'],
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'phonenumber' => $row['phonenumber'],
                    'address' => $row['address'],
                ];
            }

            // Redirect to the main page or dashboard
            $role = strpos($email, '@caratlive.com') !== false ? 'admin' : 'user';
            echo "<script>
                localStorage.setItem('user', JSON.stringify(" . json_encode($_SESSION['user']) . "));
                localStorage.setItem('role', '" . $role . "');
                localStorage.setItem('isLoggedIn',  true);
                window.location.href = 'index.php';
            </script>";

        } else {
            //Password is incorrect, set session error message
            $_SESSION['error'] = "Incorrect password.";
            header("Location: loginform.php");
            exit();
        }
    }
}
?>