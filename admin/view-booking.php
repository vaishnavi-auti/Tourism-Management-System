<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


// ================= CHECK BOOKING ID =================

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: bookings.php");
    exit();
}

$booking_id = intval($_GET['id']);


// ================= GET BOOKING =================

$sql = "SELECT * FROM bookings WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $booking_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$booking = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// ================= CHECK BOOKING =================

if (!$booking) {
    header("Location: bookings.php");
    exit();
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

    <title>Booking Details - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/admin-bookings.css">

</head>

<body>


<!-- ================= NAVBAR ================= -->

<header>

    <nav class="admin-navbar">

        <div class="admin-logo">
            Tourism<span>MS</span>
        </div>

        <div class="admin-right">

            <a href="dashboard.php" class="dashboard-btn">
                Dashboard
            </a>

            <a href="bookings.php" class="users-btn">
                Bookings
            </a>

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>

    </nav>

</header>



<!-- ================= BOOKING DETAILS ================= -->

<section class="bookings-section">

    <div class="bookings-container">

        <div class="page-title">

            <h1>Booking Details</h1>

            <p>
                Complete information about this tour booking.
            </p>

        </div>


        <div class="booking-details-box">


            <div class="detail-row">

                <div class="detail-label">
                    Booking ID
                </div>

                <div class="detail-value">
                    <?php echo $booking['id']; ?>
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Package Name
                </div>

                <div class="detail-value">
                    <?php
                    echo htmlspecialchars(
                        $booking['package_name']
                    );
                    ?>
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Customer Name
                </div>

                <div class="detail-value">
                    <?php
                    echo htmlspecialchars(
                        $booking['name']
                    );
                    ?>
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Email Address
                </div>

                <div class="detail-value">
                    <?php
                    echo htmlspecialchars(
                        $booking['email']
                    );
                    ?>
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Phone Number
                </div>

                <div class="detail-value">
                    <?php
                    echo htmlspecialchars(
                        $booking['phone']
                    );
                    ?>
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Travel Date
                </div>

                <div class="detail-value">
                    <?php
                    echo htmlspecialchars(
                        $booking['travel_date']
                    );
                    ?>
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Number of Persons
                </div>

                <div class="detail-value">
                    <?php
                    echo htmlspecialchars(
                        $booking['persons']
                    );
                    ?>
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Message
                </div>

                <div class="detail-value">

                    <?php

                    echo !empty($booking['message'])
                        ? htmlspecialchars(
                            $booking['message']
                        )
                        : "No message";

                    ?>

                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Booking Date
                </div>

                <div class="detail-value">
                    <?php
                    echo htmlspecialchars(
                        $booking['booking_date']
                    );
                    ?>
                </div>

            </div>


            <!-- ================= BACK BUTTON ================= -->

            <div class="details-actions">

                <a
                    href="bookings.php"
                    class="back-bookings-btn"
                >
                    ← Back to Bookings
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