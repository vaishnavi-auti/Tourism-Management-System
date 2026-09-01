<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


// Count users
$user_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_users FROM users"
);

$user_data = mysqli_fetch_assoc($user_query);

$total_users = $user_data['total_users'];


// Count bookings
$booking_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_bookings FROM bookings"
);

$booking_data = mysqli_fetch_assoc($booking_query);

$total_bookings = $booking_data['total_bookings'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/admin-dashboard.css">

</head>

<body>

<!-- ================= NAVBAR ================= -->

<header>

    <nav class="admin-navbar">

        <div class="admin-logo">
            Tourism<span>MS</span>
        </div>

        <div class="admin-right">

            <span>
                Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>
            </span>

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>

    </nav>

</header>


<!-- ================= DASHBOARD ================= -->

<section class="dashboard-section">

    <div class="dashboard-container">

        <h1>Admin Dashboard</h1>

        <p class="dashboard-subtitle">
            Manage your Tourism Management System
        </p>


        <!-- ================= STATISTICS ================= -->

        <div class="stats-container">


            <!-- USERS -->

            <div class="stat-card">

                <div class="stat-icon">
                    👥
                </div>

                <div>

                    <h2>
                        <?php echo $total_users; ?>
                    </h2>

                    <p>Total Users</p>

                </div>

            </div>


            <!-- BOOKINGS -->

            <div class="stat-card">

                <div class="stat-icon">
                    📋
                </div>

                <div>

                    <h2>
                        <?php echo $total_bookings; ?>
                    </h2>

                    <p>Total Bookings</p>

                </div>

            </div>


        </div>


        <!-- ================= MANAGEMENT ================= -->

        <div class="management-container">

            <h2>Management</h2>


            <div class="management-grid">


                <!-- USERS -->

                <a href="users.php" class="management-card">

                    <div class="management-icon">
                        👥
                    </div>

                    <h3>Manage Users</h3>

                    <p>
                        View registered users.
                    </p>

                </a>


                <!-- BOOKINGS -->

                <a href="bookings.php" class="management-card">

                    <div class="management-icon">
                        📋
                    </div>

                    <h3>Manage Bookings</h3>

                    <p>
                        View and manage tour bookings.
                    </p>

                </a>


                <!-- PACKAGES -->

                <a href="../packages.php" class="management-card">

                    <div class="management-icon">
                        📦
                    </div>

                    <h3>Tour Packages</h3>

                    <p>
                        View available packages.
                    </p>

                </a>


                <!-- PLACES -->

                <a href="../places.php" class="management-card">

                    <div class="management-icon">
                        🌍
                    </div>

                    <h3>Tourist Places</h3>

                    <p>
                        View tourist destinations.
                    </p>

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