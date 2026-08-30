<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tourist Places - Tourism Management System</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Places CSS -->
    <link rel="stylesheet" href="css/places.css">

</head>

<body>

<!-- =====================================================
     NAVBAR
===================================================== -->

<header>

    <nav class="navbar">

        <!-- Logo -->

        <div class="logo">
            Tourism<span>MS</span>
        </div>


        <!-- Navigation -->

        <ul class="nav-links">

            <li>
                <a href="index.php">Home</a>
            </li>

            <li>
                <a href="about.php">About</a>
            </li>

            <li>
                <a href="places.php">Places</a>
            </li>

            <li>
                <a href="packages.php">Packages</a>
            </li>

            <li>
                <a href="booking.php">Booking</a>
            </li>

            <li>
                <a href="contact.php">Contact</a>
            </li>


            <?php

            if (isset($_SESSION['user_id'])) {

            ?>

                <!-- Welcome User -->

                <li>
                    <span class="welcome">
                        Welcome,
                        <?php
                        echo htmlspecialchars($_SESSION['user_name']);
                        ?>
                    </span>
                </li>


                <!-- Logout -->

                <li>
                    <a href="logout.php" class="logout-btn">
                        Logout
                    </a>
                </li>

            <?php

            } else {

            ?>

                <!-- Login -->

                <li>
                    <a href="login.php" class="login-btn">
                        Login
                    </a>
                </li>

            <?php

            }

            ?>

        </ul>

    </nav>

</header>



<!-- =====================================================
     PAGE HEADER
===================================================== -->

<section class="places-header">

    <div class="places-header-content">

        <h1>
            Explore Tourist Places
        </h1>

        <p>
            Discover beautiful destinations and unforgettable experiences.
        </p>

    </div>

</section>



<!-- =====================================================
     TOURIST PLACES
===================================================== -->

<section class="places-section">

    <h2>
        Popular Destinations
    </h2>

    <p class="section-text">
        Explore some of the most beautiful tourist destinations in India.
    </p>


    <div class="places-container">


        <!-- =================================================
             GOA
        ================================================== -->

        <div class="tourist-card">

            <div class="tourist-image">

                <img
                    src="images/goa.jpg"
                    alt="Goa"
                >

            </div>


            <div class="tourist-content">

                <h3>
                    Goa
                </h3>

                <p>
                    Enjoy beautiful beaches, nightlife, water sports
                    and amazing coastal views.
                </p>

                <a
                    href="packages.php"
                    class="btn"
                >
                    View Packages
                </a>

            </div>

        </div>



        <!-- =================================================
             MANALI
        ================================================== -->

        <div class="tourist-card">

            <div class="tourist-image">

                <img
                    src="images/manali.jpg"
                    alt="Manali"
                >

            </div>


            <div class="tourist-content">

                <h3>
                    Manali
                </h3>

                <p>
                    Experience beautiful mountains, snow, valleys
                    and amazing natural scenery.
                </p>

                <a
                    href="packages.php"
                    class="btn"
                >
                    View Packages
                </a>

            </div>

        </div>



        <!-- =================================================
             KASHMIR
        ================================================== -->

        <div class="tourist-card">

            <div class="tourist-image">

                <img
                    src="images/kashmir.jpg"
                    alt="Kashmir"
                >

            </div>


            <div class="tourist-content">

                <h3>
                    Kashmir
                </h3>

                <p>
                    Explore stunning valleys, beautiful lakes,
                    mountains and peaceful natural beauty.
                </p>

                <a
                    href="packages.php"
                    class="btn"
                >
                    View Packages
                </a>

            </div>

        </div>



        <!-- =================================================
             RAJASTHAN
        ================================================== -->

        <div class="tourist-card">

            <div class="tourist-image">

                <img
                    src="images/rajasthan.jpg"
                    alt="Rajasthan"
                >

            </div>


            <div class="tourist-content">

                <h3>
                    Rajasthan
                </h3>

                <p>
                    Discover royal palaces, historical forts,
                    deserts and traditional culture.
                </p>

                <a
                    href="packages.php"
                    class="btn"
                >
                    View Packages
                </a>

            </div>

        </div>



        <!-- =================================================
             KERALA
        ================================================== -->

        <div class="tourist-card">

            <div class="tourist-image">

                <img
                    src="images/kerala.jpg"
                    alt="Kerala"
                >

            </div>


            <div class="tourist-content">

                <h3>
                    Kerala
                </h3>

                <p>
                    Enjoy beautiful backwaters, greenery, beaches
                    and peaceful surroundings.
                </p>

                <a
                    href="packages.php"
                    class="btn"
                >
                    View Packages
                </a>

            </div>

        </div>



        <!-- =================================================
             ANDAMAN
        ================================================== -->

        <div class="tourist-card">

            <div class="tourist-image">

                <img
                    src="images/andaman.jpg"
                    alt="Andaman"
                >

            </div>


            <div class="tourist-content">

                <h3>
                    Andaman
                </h3>

                <p>
                    Experience crystal-clear water, beautiful
                    beaches, islands and exciting activities.
                </p>

                <a
                    href="packages.php"
                    class="btn"
                >
                    View Packages
                </a>

            </div>

        </div>


    </div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer>

    <p>
        © 2026 Tourism Management System. All Rights Reserved.
    </p>

</footer>


</body>

</html>