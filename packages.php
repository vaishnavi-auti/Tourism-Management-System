<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tour Packages - Tourism Management System</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/packages.css">

</head>

<body>

<!-- ================= NAVBAR ================= -->

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

            <?php if (isset($_SESSION['user_id'])) { ?>

                <li>
                    <span class="welcome">
                        Welcome,
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
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

            <?php } ?>

        </ul>

    </nav>

</header>


<!-- ================= HEADER ================= -->

<section class="packages-header">

    <div>

        <h1>Tour Packages</h1>

        <p>
            Choose the perfect package for your next adventure.
        </p>

    </div>

</section>


<!-- ================= PACKAGES ================= -->

<section class="packages-section">

    <h2>Popular Tour Packages</h2>

    <p class="section-text">
        Select from our exciting and affordable tour packages.
    </p>


    <div class="packages-container">


        <!-- Goa -->

        <div class="package-card">

            <div class="package-image">
                <img src="images/goa.jpg" alt="Goa Tour">
            </div>

            <div class="package-content">

                <h3>Goa Beach Tour</h3>

                <p class="package-location">
                    📍 Goa
                </p>

                <p>
                    Enjoy beautiful beaches, water sports,
                    nightlife and delicious food.
                </p>

                <div class="package-info">

                    <span>📅 3 Days / 2 Nights</span>

                    <strong>₹8,999</strong>

                </div>

                <a href="booking.php" class="package-btn">
                    Book Now
                </a>

            </div>

        </div>


        <!-- Manali -->

        <div class="package-card">

            <div class="package-image">
                <img src="images/manali.jpg" alt="Manali Tour">
            </div>

            <div class="package-content">

                <h3>Manali Adventure</h3>

                <p class="package-location">
                    📍 Manali
                </p>

                <p>
                    Explore snow-covered mountains,
                    valleys and beautiful landscapes.
                </p>

                <div class="package-info">

                    <span>📅 4 Days / 3 Nights</span>

                    <strong>₹11,999</strong>

                </div>

                <a href="booking.php" class="package-btn">
                    Book Now
                </a>

            </div>

        </div>


        <!-- Kashmir -->

        <div class="package-card">

            <div class="package-image">
                <img src="images/kashmir.jpg" alt="Kashmir Tour">
            </div>

            <div class="package-content">

                <h3>Kashmir Paradise</h3>

                <p class="package-location">
                    📍 Kashmir
                </p>

                <p>
                    Experience beautiful valleys, lakes,
                    mountains and peaceful surroundings.
                </p>

                <div class="package-info">

                    <span>📅 5 Days / 4 Nights</span>

                    <strong>₹15,999</strong>

                </div>

                <a href="booking.php" class="package-btn">
                    Book Now
                </a>

            </div>

        </div>


        <!-- Rajasthan -->

        <div class="package-card">

            <div class="package-image">
                <img src="images/rajasthan.jpg" alt="Rajasthan Tour">
            </div>

            <div class="package-content">

                <h3>Royal Rajasthan</h3>

                <p class="package-location">
                    📍 Rajasthan
                </p>

                <p>
                    Discover royal palaces, forts,
                    deserts and traditional culture.
                </p>

                <div class="package-info">

                    <span>📅 5 Days / 4 Nights</span>

                    <strong>₹13,999</strong>

                </div>

                <a href="booking.php" class="package-btn">
                    Book Now
                </a>

            </div>

        </div>


        <!-- Kerala -->

        <div class="package-card">

            <div class="package-image">
                <img src="images/kerala.jpg" alt="Kerala Tour">
            </div>

            <div class="package-content">

                <h3>Kerala Nature Tour</h3>

                <p class="package-location">
                    📍 Kerala
                </p>

                <p>
                    Enjoy backwaters, greenery,
                    beaches and peaceful nature.
                </p>

                <div class="package-info">

                    <span>📅 4 Days / 3 Nights</span>

                    <strong>₹10,999</strong>

                </div>

                <a href="booking.php" class="package-btn">
                    Book Now
                </a>

            </div>

        </div>


        <!-- Andaman -->

        <div class="package-card">

            <div class="package-image">
                <img src="images/andaman.jpg" alt="Andaman Tour">
            </div>

            <div class="package-content">

                <h3>Andaman Island</h3>

                <p class="package-location">
                    📍 Andaman
                </p>

                <p>
                    Enjoy crystal-clear water, beaches,
                    islands and exciting activities.
                </p>

                <div class="package-info">

                    <span>📅 5 Days / 4 Nights</span>

                    <strong>₹18,999</strong>

                </div>

                <a href="booking.php" class="package-btn">
                    Book Now
                </a>

            </div>

        </div>


    </div>

</section>


<!-- ================= FOOTER ================= -->

<footer>

    <p>
        © 2026 Tourism Management System. All Rights Reserved.
    </p>

</footer>

</body>

</html>