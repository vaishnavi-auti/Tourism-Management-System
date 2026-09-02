<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Get all bookings
$sql = "SELECT * FROM bookings ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Bookings - Tourism Management System</title>

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

            <a href="users.php" class="users-btn">
                Users
            </a>

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>

    </nav>

</header>


<!-- ================= BOOKINGS SECTION ================= -->

<section class="bookings-section">

    <div class="bookings-container">

        <div class="page-title">

            <h1>Manage Bookings</h1>

            <p>
                View all tour bookings made by users.
            </p>

        </div>


        <!-- ================= BOOKINGS TABLE ================= -->

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Package</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>Travel Date</th>

                        <th>Persons</th>

                        <th>Message</th>

                        <th>Booking Date</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    if (mysqli_num_rows($result) > 0) {

                        while ($booking = mysqli_fetch_assoc($result)) {

                    ?>

                    <tr>

                        <td>
                            <?php echo $booking['id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($booking['package_name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($booking['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($booking['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($booking['phone']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($booking['travel_date']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($booking['persons']); ?>
                        </td>

                        <td>
                            <?php

                            echo !empty($booking['message'])
                                ? htmlspecialchars($booking['message'])
                                : "No message";

                            ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($booking['booking_date']); ?>
                        </td>

                    </tr>

                    <?php

                        }

                    } else {

                    ?>

                    <tr>

                        <td colspan="9" class="no-data">
                            No bookings found.
                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

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