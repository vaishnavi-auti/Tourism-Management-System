<?php

session_start();

include "config/database.php";


// ================= MESSAGE =================

$message = "";
$message_type = "";


// ================= SELECTED PACKAGE =================

// Get package name from URL
$selected_package = "";

if (isset($_GET['package'])) {

    $selected_package = trim($_GET['package']);

}


// ================= FETCH PACKAGES =================

$packages_query = mysqli_query(
    $conn,
    "SELECT * FROM packages ORDER BY id DESC"
);


// ================= BOOKING =================

if (isset($_POST['book'])) {

    $package_name = trim($_POST['package_name']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $travel_date = $_POST['travel_date'];
    $persons = $_POST['persons'];
    $user_message = trim($_POST['message']);


    // Keep selected package after form submission
    $selected_package = $package_name;


    // ================= CHECK TRAVEL DATE =================

    if (strtotime($travel_date) < strtotime(date("Y-m-d"))) {

        $message = "Please select a future travel date.";
        $message_type = "error";

    } else {


        // ================= INSERT BOOKING =================

        $sql = "INSERT INTO bookings
                (
                    user_id,
                    package_name,
                    name,
                    email,
                    phone,
                    travel_date,
                    persons,
                    message
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";


        $stmt = mysqli_prepare($conn, $sql);


        if ($stmt) {

            $user_id = isset($_SESSION['user_id'])
                ? $_SESSION['user_id']
                : null;


            mysqli_stmt_bind_param(
                $stmt,
                "isssssis",
                $user_id,
                $package_name,
                $name,
                $email,
                $phone,
                $travel_date,
                $persons,
                $user_message
            );


            if (mysqli_stmt_execute($stmt)) {

                $message = "Booking successful! We will contact you soon.";
                $message_type = "success";

            } else {

                $message = "Booking failed. Please try again.";
                $message_type = "error";

            }


            mysqli_stmt_close($stmt);


        } else {

            $message = "Something went wrong. Please try again.";
            $message_type = "error";

        }

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Book Your Tour - Tourism Management System
    </title>


    <link
        rel="stylesheet"
        href="css/style.css"
    >

    <link
        rel="stylesheet"
        href="css/booking.css"
    >

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



<!-- ================= PAGE HEADER ================= -->

<section class="booking-header">

    <div>

        <h1>
            Book Your Tour
        </h1>

        <p>
            Plan your journey and create unforgettable memories.
        </p>

    </div>

</section>



<!-- ================= BOOKING SECTION ================= -->

<section class="booking-section">


    <div class="booking-container">


        <!-- ================= LEFT INFORMATION ================= -->

        <div class="booking-info">


            <h2>
                Start Your Journey
            </h2>


            <p>
                Fill in the booking form and choose your favourite
                destination.
            </p>



            <div class="booking-feature">

                <h3>
                    🌍 Beautiful Destinations
                </h3>

                <p>
                    Explore some of the most amazing places in India.
                </p>

            </div>



            <div class="booking-feature">

                <h3>
                    💰 Affordable Packages
                </h3>

                <p>
                    Choose packages suitable for your budget.
                </p>

            </div>



            <div class="booking-feature">

                <h3>
                    🛡️ Safe & Easy Booking
                </h3>

                <p>
                    Simple and secure booking process.
                </p>

            </div>


        </div>



        <!-- ================= BOOKING FORM ================= -->

        <div class="booking-box">


            <h2>
                Tour Booking Form
            </h2>



            <!-- ================= MESSAGE ================= -->

            <?php if ($message != "") { ?>

                <div
                    class="booking-message
                    <?php echo $message_type; ?>"
                >

                    <?php
                    echo htmlspecialchars($message);
                    ?>

                </div>

            <?php } ?>



            <!-- ================= FORM ================= -->

            <form
                method="POST"
                onsubmit="return validateBookingForm();"
            >


                <!-- ================= PACKAGE ================= -->

                <label>
                    Choose Package
                </label>


                <select
                    name="package_name"
                    required
                >


                    <option value="">
                        Select Tour Package
                    </option>



                    <?php if (mysqli_num_rows($packages_query) > 0) { ?>


                        <?php while ($package = mysqli_fetch_assoc($packages_query)) { ?>


                            <?php

                            // Compare package names safely
                            $is_selected =
                                strtolower(trim($selected_package))
                                ===
                                strtolower(trim($package['package_name']));

                            ?>


                            <option
                                value="<?php echo htmlspecialchars($package['package_name']); ?>"
                                <?php
                                if ($is_selected) {
                                    echo "selected";
                                }
                                ?>
                            >

                                <?php
                                echo htmlspecialchars(
                                    $package['package_name']
                                );
                                ?>

                                -

                                ₹<?php
                                echo number_format(
                                    $package['price'],
                                    2
                                );
                                ?>

                            </option>


                        <?php } ?>


                    <?php } else { ?>


                        <option
                            value=""
                            disabled
                        >
                            No packages available
                        </option>


                    <?php } ?>


                </select>



                <!-- ================= NAME ================= -->

                <label>
                    Full Name
                </label>


                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Enter your full name"
                    required
                >



                <!-- ================= EMAIL ================= -->

                <label>
                    Email
                </label>


                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter your email"
                    required
                >



                <!-- ================= PHONE ================= -->

                <label>
                    Phone Number
                </label>


                <input
                    type="text"
                    name="phone"
                    id="phone"
                    placeholder="Enter 10 digit phone number"
                    maxlength="10"
                    required
                >



                <!-- ================= TRAVEL DATE ================= -->

                <label>
                    Travel Date
                </label>


                <input
                    type="date"
                    name="travel_date"
                    id="travel_date"
                    min="<?php echo date('Y-m-d'); ?>"
                    required
                >



                <!-- ================= PERSONS ================= -->

                <label>
                    Number of Persons
                </label>


                <input
                    type="number"
                    name="persons"
                    id="persons"
                    min="1"
                    max="20"
                    placeholder="Enter number of persons"
                    required
                >



                <!-- ================= MESSAGE ================= -->

                <label>
                    Message
                </label>


                <textarea
                    name="message"
                    rows="4"
                    placeholder="Any special requirements?"
                ></textarea>



                <!-- ================= BUTTON ================= -->

                <button
                    type="submit"
                    name="book"
                    class="booking-btn"
                >
                    Book Now
                </button>


            </form>


        </div>


    </div>

</section>



<!-- ================= FOOTER ================= -->

<footer>

    <p>
        © 2026 Tourism Management System. All Rights Reserved.
    </p>

</footer>



<script src="js/booking.js"></script>


</body>

</html>