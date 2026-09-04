<?php

session_start();

include "../config/database.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM contact_messages ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Messages - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin-contact-messages.css">

</head>

<body>

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

            <a href="bookings.php" class="bookings-btn">
                Bookings
            </a>

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>

    </nav>

</header>


<section class="messages-section">

    <div class="messages-container">

        <div class="page-title">

            <h1>Contact Messages</h1>

            <p>
                View messages submitted by users through the contact form.
            </p>

        </div>


        <div class="table-box">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>

                </thead>


                <tbody>

                <?php

                if (mysqli_num_rows($result) > 0) {

                    while ($message = mysqli_fetch_assoc($result)) {

                ?>

                    <tr>

                        <td>
                            <?php echo $message['id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($message['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($message['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($message['subject']); ?>
                        </td>

                        <td class="message-column">
                            <?php echo htmlspecialchars($message['message']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($message['created_at']); ?>
                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="6" class="no-data">
                            No contact messages found.
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</section>


<footer>

    <p>
        © 2026 Tourism Management System. All Rights Reserved.
    </p>

</footer>

</body>

</html>