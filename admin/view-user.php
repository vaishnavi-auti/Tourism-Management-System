<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


// ================= CHECK USER ID =================

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$user_id = intval($_GET['id']);


// ================= GET USER =================

$sql = "SELECT id, name, email, phone, created_at
        FROM users
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// ================= CHECK USER =================

if (!$user) {
    header("Location: users.php");
    exit();
}


// ================= GET USER BOOKINGS =================

$booking_sql = "SELECT id, package_name, travel_date, persons, message, booking_date
                FROM bookings
                WHERE user_id = ?
                ORDER BY id DESC";

$booking_stmt = mysqli_prepare($conn, $booking_sql);

mysqli_stmt_bind_param(
    $booking_stmt,
    "i",
    $user_id
);

mysqli_stmt_execute($booking_stmt);

$booking_result = mysqli_stmt_get_result($booking_stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>User Details - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/admin-users.css">

    <link rel="stylesheet" href="../css/admin-view-user.css">

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

            <a href="users.php" class="users-btn">
                Users
            </a>

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>

    </nav>

</header>



<!-- ================= USER DETAILS ================= -->

<section class="users-section">

    <div class="users-container">

        <div class="page-title">

            <h1>User Details</h1>

            <p>
                Complete information about this registered user.
            </p>

        </div>


        <!-- ================= DETAILS BOX ================= -->

        <div class="user-details-box">


            <!-- User ID -->

            <div class="detail-row">

                <div class="detail-label">
                    User ID
                </div>

                <div class="detail-value">
                    <?php
                    echo $user['id'];
                    ?>
                </div>

            </div>


            <!-- Name -->

            <div class="detail-row">

                <div class="detail-label">
                    Name
                </div>

                <div class="detail-value">

                    <?php
                    echo htmlspecialchars(
                        $user['name']
                    );
                    ?>

                </div>

            </div>


            <!-- Email -->

            <div class="detail-row">

                <div class="detail-label">
                    Email Address
                </div>

                <div class="detail-value">

                    <?php
                    echo htmlspecialchars(
                        $user['email']
                    );
                    ?>

                </div>

            </div>


            <!-- Phone -->

            <div class="detail-row">

                <div class="detail-label">
                    Phone Number
                </div>

                <div class="detail-value">

                    <?php
                    echo htmlspecialchars(
                        $user['phone']
                    );
                    ?>

                </div>

            </div>


            <!-- Registration Date -->

            <div class="detail-row">

                <div class="detail-label">
                    Registration Date
                </div>

                <div class="detail-value">

                    <?php
                    echo htmlspecialchars(
                        $user['created_at']
                    );
                    ?>

                </div>

            </div>

        </div>



        <!-- ================= BOOKING HISTORY ================= -->

        <div class="booking-history-box">

            <div class="booking-history-title">

                <h2>Booking History</h2>

                <p>
                    Tour bookings made by this user.
                </p>

            </div>


            <div class="booking-table-box">

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Package</th>

                            <th>Travel Date</th>

                            <th>Persons</th>

                            <th>Message</th>

                            <th>Booking Date</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php

                        if (mysqli_num_rows($booking_result) > 0) {

                            while (
                                $booking = mysqli_fetch_assoc(
                                    $booking_result
                                )
                            ) {

                        ?>

                        <tr>

                            <td>
                                <?php
                                echo $booking['id'];
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $booking['package_name']
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $booking['travel_date']
                                );
                                ?>
                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $booking['persons']
                                );
                                ?>
                            </td>


                            <td>

                                <?php

                                echo !empty(
                                    $booking['message']
                                )
                                    ? htmlspecialchars(
                                        $booking['message']
                                    )
                                    : "No message";

                                ?>

                            </td>


                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $booking['booking_date']
                                );
                                ?>
                            </td>

                        </tr>

                        <?php

                            }

                        } else {

                        ?>

                        <tr>

                            <td
                                colspan="6"
                                class="no-bookings"
                            >
                                No bookings found for this user.
                            </td>

                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>



        <!-- ================= BACK BUTTON ================= -->

        <div class="details-actions">

            <a
                href="users.php"
                class="back-users-btn"
            >
                ← Back to Users
            </a>

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

<?php

mysqli_stmt_close($booking_stmt);

?>