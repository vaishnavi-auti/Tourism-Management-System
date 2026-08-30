<?php

include "config/database.php";

$message = "";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check password
    if ($password != $confirm_password) {

        $message = "Passwords do not match!";

    } else {

        // Check email already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($check) > 0) {

            $message = "Email already registered!";

        } else {

            // Secure password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users 
                    (name, email, phone, password)
                    VALUES
                    ('$name', '$email', '$phone', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {

                $message = "Registration successful!";

            } else {

                $message = "Registration failed!";

            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Tourism Management System</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/register.css">

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
            <li><a href="login.php" class="login-btn">Login</a></li>

        </ul>

    </nav>

</header>


<section class="register-section">

    <div class="register-box">

        <h2>Create Account</h2>

        <p>Register to explore and book tour packages.</p>

        <?php if ($message != "") { ?>

            <div class="message">
                <?php echo $message; ?>
            </div>

        <?php } ?>


        <form method="POST">

            <label>Full Name</label>

            <input
                type="text"
                name="name"
                placeholder="Enter your name"
                required
            >


            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >


            <label>Phone Number</label>

            <input
                type="text"
                name="phone"
                placeholder="Enter phone number"
                required
            >


            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter password"
                required
            >


            <label>Confirm Password</label>

            <input
                type="password"
                name="confirm_password"
                placeholder="Confirm password"
                required
            >


            <button type="submit" name="register">
                Register
            </button>

        </form>


        <p class="login-text">
            Already have an account?
            <a href="login.php">Login</a>
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