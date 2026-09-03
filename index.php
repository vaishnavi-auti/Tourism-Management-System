<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tourism Management System</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- Navigation Bar -->
    <header>

        <nav class="navbar">

            <div class="logo">
                Tourism<span>MS</span>
            </div>

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


                <?php if (isset($_SESSION['user_id'])) { ?>

                    <!-- Welcome User -->

                    <li>
                        <span class="welcome">
                            Welcome,
                            <?php
                            echo htmlspecialchars($_SESSION['user_name']);
                            ?>
                        </span>
                    </li>


                    <!-- My Bookings -->

                    <li>
                        <a href="my-bookings.php" class="my-bookings-btn">
                            My Bookings
                        </a>
                    </li>


                    <!-- Logout -->

                    <li>
                        <a href="logout.php" class="logout-btn">
                            Logout
                        </a>
                    </li>


                <?php } else { ?>


                    <!-- Login -->

                    <li>
                        <a href="login.php" class="login-btn">
                            Login
                        </a>
                    </li>


                    <!-- Register -->

                    <li>
                        <a href="register.php" class="register-btn">
                            Register
                        </a>
                    </li>


                <?php } ?>

            </ul>

        </nav>

    </header>


    <!-- Hero Section -->

    <section class="hero">

        <div class="hero-content">

            <h1>
                Explore The World
            </h1>

            <p>
                Discover beautiful places, exciting destinations
                and amazing tour packages with us.
            </p>

            <a href="packages.php" class="btn">
                Explore Packages
            </a>

        </div>

    </section>


    <!-- Popular Destinations -->

    <section class="destinations">

        <h2>
            Popular Tourist Places
        </h2>

        <p class="section-text">
            Explore some of the most beautiful tourist destinations.
        </p>


        <div class="place-container">


            <!-- Goa -->

            <div class="place-card">

                <div class="place-image">
                    🏖️
                </div>

                <h3>
                    Goa
                </h3>

                <p>
                    Beautiful beaches and amazing nightlife.
                </p>

                <a href="places.php">
                    Explore
                </a>

            </div>


            <!-- Manali -->

            <div class="place-card">

                <div class="place-image">
                    🏔️
                </div>

                <h3>
                    Manali
                </h3>

                <p>
                    Enjoy mountains, snow and natural beauty.
                </p>

                <a href="places.php">
                    Explore
                </a>

            </div>


            <!-- Rajasthan -->

            <div class="place-card">

                <div class="place-image">
                    🏰
                </div>

                <h3>
                    Rajasthan
                </h3>

                <p>
                    Explore forts, palaces and Indian culture.
                </p>

                <a href="places.php">
                    Explore
                </a>

            </div>


        </div>

    </section>


    <!-- Why Choose Us -->

    <section class="why-us">

        <h2>
            Why Choose Us?
        </h2>


        <div class="features">


            <!-- Feature 1 -->

            <div class="feature">

                <h3>
                    🌍 Best Destinations
                </h3>

                <p>
                    We provide information about beautiful
                    tourist destinations.
                </p>

            </div>


            <!-- Feature 2 -->

            <div class="feature">

                <h3>
                    💰 Affordable Packages
                </h3>

                <p>
                    Choose tour packages according to your budget.
                </p>

            </div>


            <!-- Feature 3 -->

            <div class="feature">

                <h3>
                    📞 Easy Booking
                </h3>

                <p>
                    Book your favourite tour package easily.
                </p>

            </div>


        </div>

    </section>


    <!-- Footer -->

    <footer>

        <p>
            © 2026 Tourism Management System. All Rights Reserved.
        </p>

    </footer>


    <!-- JavaScript -->

    <script src="js/script.js"></script>

</body>

</html>