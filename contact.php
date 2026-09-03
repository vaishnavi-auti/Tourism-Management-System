<?php
session_start();

include "config/database.php";

$message = "";

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message_text = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message_text)) {

        $message = "Please fill all fields.";

    } else {

        // For now, display success message.
        // Contact messages can be stored in database later if required.

        $message = "Thank you! Your message has been submitted successfully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us - Tourism Management System</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">

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
            <li><a href="contact.php" class="active">Contact</a></li>

            <?php if (isset($_SESSION['user_id'])) { ?>

                <li>
                    <span class="welcome">
                        Welcome,
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                </li>

                <li>
                    <a href="my-bookings.php" class="my-bookings-btn">
                        My Bookings
                    </a>
                </li>

                <li>
                    <a href="logout.php" class="logout-btn">
                        Logout
                    </a>
                </li>

            <?php } else { ?>

                <li>
                    <a href="login.php" class="login-btn">
                        Login
                    </a>
                </li>

                <li>
                    <a href="register.php" class="register-btn">
                        Register
                    </a>
                </li>

            <?php } ?>

        </ul>

    </nav>

</header>


<section class="contact-section">

    <div class="contact-container">

        <div class="contact-title">

            <h1>Contact Us</h1>

            <p>
                Have any questions or need help?
                Feel free to contact us.
            </p>

        </div>


        <?php if (!empty($message)) { ?>

            <div class="success-message">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php } ?>


        <div class="contact-box">

            <div class="contact-info">

                <h2>Get In Touch</h2>

                <p>
                    We are here to help you with your
                    tourism and booking related queries.
                </p>

                <p>
                    <strong>Email:</strong>
                    tourismms@gmail.com
                </p>

                <p>
                    <strong>Phone:</strong>
                    +91 9876543210
                </p>

                <p>
                    <strong>Location:</strong>
                    Maharashtra, India
                </p>

            </div>


            <div class="contact-form">

                <form method="POST" action="">

                    <label>Name</label>

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


                    <label>Subject</label>

                    <input
                        type="text"
                        name="subject"
                        placeholder="Enter subject"
                        required
                    >


                    <label>Message</label>

                    <textarea
                        name="message"
                        rows="5"
                        placeholder="Enter your message"
                        required
                    ></textarea>


                    <button type="submit" name="submit">
                        Send Message
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>


<footer>

    <p>
        © 2026 Tourism Management System. All Rights Reserved.
    </p>

</footer>

</body>

</html>