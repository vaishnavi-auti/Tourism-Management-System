<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


// Get all contact messages
$sql = "SELECT * FROM contact_messages ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Contact Messages - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link
        rel="stylesheet"
        href="../css/admin-contact-messages.css"
    >

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



<!-- ================= CONTACT MESSAGES ================= -->

<section class="messages-section">

    <div class="messages-container">

        <div class="page-title">

            <h1>Contact Messages</h1>

            <p>
                View messages submitted by users through the contact form.
            </p>

        </div>



        <!-- ================= SUCCESS / ERROR MESSAGE ================= -->

        <?php if (isset($_GET['deleted'])) { ?>

            <?php if ($_GET['deleted'] == "success") { ?>

                <div class="message-alert success">
                    Message deleted successfully.
                </div>

            <?php } elseif ($_GET['deleted'] == "error") { ?>

                <div class="message-alert error">
                    Failed to delete message.
                </div>

            <?php } ?>

        <?php } ?>



        <!-- ================= MESSAGES TABLE ================= -->

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

                        <th>Action</th>

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
                            <?php
                            echo htmlspecialchars(
                                $message['name']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $message['email']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $message['subject']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $message['message']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $message['created_at']
                            );
                            ?>
                        </td>


                        <!-- ================= DELETE BUTTON ================= -->

                        <td>

                            <a
                                href="delete-message.php?id=<?php echo $message['id']; ?>"
                                class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete this message?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>

                    <?php

                        }

                    } else {

                    ?>

                    <tr>

                        <td colspan="7" class="no-data">

                            No contact messages found.

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
