<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


// ================= SEARCH =================

$search = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}


// ================= GET USERS =================

if ($search != "") {

    $search_value = "%" . $search . "%";

    $sql = "SELECT id, name, email, phone
            FROM users
            WHERE name LIKE ?
            OR email LIKE ?
            OR phone LIKE ?
            ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $search_value,
        $search_value,
        $search_value
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

} else {

    $sql = "SELECT id, name, email, phone
            FROM users
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);
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



        <!-- ================= SUCCESS / ERROR MESSAGE ================= -->

        <?php if (isset($_GET['deleted'])) { ?>

            <?php if ($_GET['deleted'] == "success") { ?>

                <div class="user-message success">
                    User deleted successfully.
                </div>

            <?php } elseif ($_GET['deleted'] == "error") { ?>

                <div class="user-message error">
                    Failed to delete user.
                </div>

            <?php } ?>

        <?php } ?>



        <!-- ================= SEARCH BOX ================= -->

        <div class="user-search">

            <form method="GET">

                <input
                    type="text"
                    name="search"
                    placeholder="Search by name, email or phone..."
                    value="<?php echo htmlspecialchars($search); ?>"
                >

                <button type="submit">
                    Search
                </button>

                <?php if ($search != "") { ?>

                    <a href="users.php" class="clear-search">
                        Clear
                    </a>

                <?php } ?>

            </form>

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

                        <th>Action</th>

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
                            <?php
                            echo htmlspecialchars(
                                $user['name']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $user['email']
                            );
                            ?>
                        </td>


                        <td>
                            <?php
                            echo htmlspecialchars(
                                $user['phone']
                            );
                            ?>
                        </td>


                        <!-- ================= DELETE BUTTON ================= -->

                        <td>

                            <a
                                href="delete-user.php?id=<?php echo $user['id']; ?>"
                                class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete this user?');"
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

                        <td colspan="5" class="no-data">

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