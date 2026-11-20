<?php

session_start();

include "../config/database.php";

// ================= ADMIN LOGIN CHECK =================

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

    $sql = "SELECT id, name, email, phone, created_at
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

    $sql = "SELECT id, name, email, phone, created_at
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

    <title>Registered Users - TourismMS</title>

    <link
        rel="stylesheet"
        href="../css/style.css"
    >

    <link
        rel="stylesheet"
        href="../css/admin-users.css"
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

            <a
                href="dashboard.php"
                class="dashboard-btn"
            >
                Dashboard
            </a>


            <a
                href="logout.php"
                class="admin-logout"
            >
                Logout
            </a>

        </div>

    </nav>

</header>



<!-- ================= USERS SECTION ================= -->

<section class="users-section">

    <div class="users-container">


        <!-- ================= PAGE TITLE ================= -->

        <div class="page-title">

            <h1>
                Registered Users
            </h1>

            <p>
                View and manage all users registered in the Tourism Management System.
            </p>

        </div>



        <!-- ================= SEARCH ================= -->

        <div class="search-box">

            <form
                method="GET"
                action=""
            >

                <input
                    type="text"
                    name="search"
                    placeholder="Search by name, email or phone..."
                    value="<?php echo htmlspecialchars($search); ?>"
                >

                <button
                    type="submit"
                    class="search-btn"
                >
                    Search
                </button>


                <?php if ($search != "") { ?>

                    <a
                        href="users.php"
                        class="clear-btn"
                    >
                        Clear
                    </a>

                <?php } ?>

            </form>

        </div>



        <!-- ================= USERS TABLE ================= -->

        <div class="users-table-box">

            <table>

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Phone
                        </th>

                        <th>
                            Registration Date
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php

                    if (
                        $result &&
                        mysqli_num_rows($result) > 0
                    ) {

                        while (
                            $user = mysqli_fetch_assoc($result)
                        ) {

                    ?>

                    <tr>


                        <!-- ID -->

                        <td>

                            <?php
                            echo $user['id'];
                            ?>

                        </td>



                        <!-- NAME -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user['name']
                            );
                            ?>

                        </td>



                        <!-- EMAIL -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user['email']
                            );
                            ?>

                        </td>



                        <!-- PHONE -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user['phone']
                            );
                            ?>

                        </td>



                        <!-- REGISTRATION DATE -->

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $user['created_at']
                            );
                            ?>

                        </td>



                        <!-- ACTION -->

                        <td>

                            <a
                                href="view-user.php?id=<?php echo $user['id']; ?>"
                                class="view-btn"
                            >
                                View
                            </a>


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

                        <td
                            colspan="6"
                            class="no-users"
                        >
                            No users found.
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

<?php

if (isset($stmt)) {
    mysqli_stmt_close($stmt);
}

?>