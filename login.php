<?php

session_start();

include "config/database.php";

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Find user by email
    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // Check password
        if (password_verify($password, $user['password'])) {

            // Create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to home
            header("Location: index.php");
            exit();

        } else {

            $message = "Incorrect password!";

        }

    } else {

        $message = "Email not registered!";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Tourism Management System</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body>

<header>

    <nav class="navbar">

        <div class="logo">
            Tourism<span>MS</span>
        </div>

        <ul class="nav-links">

            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="places.php">Places</a></li>
            <li><a href="packages.php">Packages</a></li>
            <li><a href="booking.php">Booking</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="register.php">Register</a></li>

        </ul>

    </nav>

</header>


<!-- Login Section -->

<section class="login-section">

    <div class="login-box">

        <h2>Welcome Back!</h2>

        <p>Login to your TourismMS account.</p>


        <?php if ($message != "") { ?>

            <div class="message">
                <?php echo $message; ?>
            </div>

        <?php } ?>


        <form method="POST">

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >


            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >


            <button type="submit" name="login">
                Login
            </button>

        </form>


        <p class="register-text">

            Don't have an account?

            <a href="register.php">
                Register
            </a>

        </p>

    </div>

</section>


<footer>

    <p>
        © 2026 Tourism Management System. All Rights Reserved.
    </p>

</footer>

</body>

</html>