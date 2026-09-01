<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Get all users
$sql = "SELECT id, name, email, phone FROM users ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/admin-users.css">

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

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>

    </nav>

</header>


<!-- ================= USERS SECTION ================= -->

<section class="users-section">

    <div class="users-container">

        <div class="page-title">

            <h1>Registered Users</h1>

            <p>
                View all users registered in the Tourism Management System.
            </p>

        </div>


        <!-- ================= USERS TABLE ================= -->

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    if (mysqli_num_rows($result) > 0) {

                        while ($user = mysqli_fetch_assoc($result)) {

                    ?>

                    <tr>

                        <td>
                            <?php echo $user['id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($user['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($user['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($user['phone']); ?>
                        </td>

                    </tr>

                    <?php

                        }

                    } else {

                    ?>

                    <tr>

                        <td colspan="4" class="no-data">
                            No registered users found.
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