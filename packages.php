<?php

session_start();

include "config/database.php";


// Fetch all packages from database

$query = mysqli_query(
    $conn,
    "SELECT * FROM packages ORDER BY id DESC"
);

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

            <li>
                <a href="index.php">
                    Home
                </a>
            </li>

            <li>
                <a href="about.php">
                    About
                </a>
            </li>

            <li>
                <a href="places.php">
                    Places
                </a>
            </li>

            <li>
                <a href="packages.php">
                    Packages
                </a>
            </li>

            <li>
                <a href="booking.php">
                    Booking
                </a>
            </li>

            <li>
                <a href="contact.php">
                    Contact
                </a>
            </li>


            <?php if (isset($_SESSION['user_id'])) { ?>


                <li>

                    <span class="welcome">

                        Welcome,
                        <?php
                        echo htmlspecialchars(
                            $_SESSION['user_name']
                        );
                        ?>

                    </span>

                </li>


                <li>

                    <a
                        href="logout.php"
                        class="logout-btn"
                    >
                        Logout
                    </a>

                </li>


            <?php } else { ?>


                <li>

                    <a
                        href="login.php"
                        class="login-btn"
                    >
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

        <h1>
            Tour Packages
        </h1>

        <p>
            Choose the perfect package for your next adventure.
        </p>

    </div>

</section>



<!-- ================= PACKAGES ================= -->

<section class="packages-section">

    <h2>
        Popular Tour Packages
    </h2>


    <p class="section-text">
        Select from our exciting and affordable tour packages.
    </p>



    <div class="packages-container">


        <?php if (mysqli_num_rows($query) > 0) { ?>


            <?php while ($package = mysqli_fetch_assoc($query)) { ?>


                <!-- ================= PACKAGE CARD ================= -->

                <div class="package-card">


                    <!-- Package Image -->

                    <div class="package-image">


                        <?php if (!empty($package['image'])) { ?>


                            <img
                                src="images/<?php echo htmlspecialchars($package['image']); ?>"
                                alt="<?php echo htmlspecialchars($package['package_name']); ?>"
                            >


                        <?php } else { ?>


                            <div class="no-package-image">
                                No Image
                            </div>


                        <?php } ?>


                    </div>



                    <!-- Package Content -->

                    <div class="package-content">


                        <!-- Package Name -->

                        <h3>

                            <?php
                            echo htmlspecialchars(
                                $package['package_name']
                            );
                            ?>

                        </h3>



                        <!-- Destination -->

                        <p class="package-location">

                            📍

                            <?php
                            echo htmlspecialchars(
                                $package['destination']
                            );
                            ?>

                        </p>



                        <!-- Description -->

                        <p>

                            <?php
                            echo htmlspecialchars(
                                $package['description']
                            );
                            ?>

                        </p>



                        <!-- Package Information -->

                        <div class="package-info">


                            <span>

                                📅

                                <?php
                                echo htmlspecialchars(
                                    $package['duration']
                                );
                                ?>

                            </span>


                            <strong>

                                ₹<?php
                                echo number_format(
                                    $package['price'],
                                    2
                                );
                                ?>

                            </strong>


                        </div>



                        <!-- Book Now -->

                        <a
                            href="booking.php"
                            class="package-btn"
                        >
                            Book Now
                        </a>


                    </div>


                </div>


            <?php } ?>


        <?php } else { ?>


            <!-- ================= NO PACKAGES ================= -->

            <div class="no-packages">

                <h2>
                    No Tour Packages Available
                </h2>

                <p>
                    Please check again later for available tour packages.
                </p>

            </div>


        <?php } ?>


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